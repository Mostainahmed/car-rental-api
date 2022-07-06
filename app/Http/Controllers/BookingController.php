<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Http\Requests\StatusRequest;
use App\Http\Resources\BookingResource;
use App\Http\Resources\CarResource;
use App\Http\Resources\FuelPolicyResource;
use App\Models\Booking;
use App\Models\Car;
use App\Models\FuelPolicy;
use App\Services\LocationService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class BookingController extends BaseController
{
    public $booking;
    public function __construct()
    {
        $this->booking = new Booking;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return BookingResource::collection($this->booking->getBookings($request));
    }

    /**
     * Display a specific resource.
     *
     * @return BookingResource
     */
    public function show($id){
        return new BookingResource(Booking::find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Booking $booking
     * @param ApiResponseHelper $apiResponseHelper
     * @param LocationService $locationService
     * @return JsonResponse
     */
    public function store(Request $request, Booking $booking, ApiResponseHelper $apiResponseHelper, LocationService $locationService): JsonResponse
    {
        $rules = array(
            "user_id" => "required|exists:users,id",
            "total_cost" => "required",
            "pickup_location" => "required",
            "arrival_location" => "sometimes",
            "fuel_policy_id" => "required|exists:fuel_policies,id",
            "rental_type_id" => "required|exists:rental_types,id",
            "car_specification_id" => "required|exists:car_specifications,id",
            "travel_status" => "required|in:ONGOING,BOOKED,FINISHED,PARKED",
            "insurance_policy_id" => "required|exists:insurance_policies,id",
            "date_of_travel" => "sometimes|date",
            "booked_date" => "sometimes|date"
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $message = config('settings.message.validation_fail');
            return $apiResponseHelper::returnError("VALIDATION_ERROR", Response::HTTP_BAD_REQUEST, $message, $validator->errors()->messages());
        }
        $request = $this->setLatAndLngInRequest($request, $locationService);
        DB::beginTransaction();
        try{
            $input = $request->all();
            $booking = Booking::create($input);
            DB::commit();

            $message = config('settings.message.saved');
            return $apiResponseHelper::returnSuccess($message, $booking, Response::HTTP_CREATED);
        }catch (Exception $e) {
            DB::rollBack();
            return $apiResponseHelper::returnError("BAD_REQUEST", Response::HTTP_BAD_REQUEST, $e->getMessage(), config('settings.message.fatal_error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $uuid
     * @param ApiResponseHelper $apiResponseHelper
     * @return JsonResponse
     */
    public function update(Request $request, $uuid, ApiResponseHelper $apiResponseHelper): JsonResponse
    {
        $booking = Booking::find($uuid);
        if (!$booking) {
            $message = config('settings.message.not_found');
            return $apiResponseHelper::returnError("NOT_FOUND", Response::HTTP_NOT_FOUND, null, $message);
        }
        $rules = array(
            "user_id" => "required|exists:users,id",
            "total_cost" => "required",
            "pickup_location" => "sometimes",
            "arrival_location" => "sometimes",
            "fuel_policy_id" => "sometimes|exists:fuel_policies,id",
            "rental_type_id" => "sometimes|exists:rental_types,id",
            "car_specification_id" => "sometimes|exists:car_specifications,id",
            "travel_status" => "sometimes|in:ONGOING,BOOKED,FINISHED,PARKED",
            "insurance_policy_id" => "sometimes|exists:insurance_policies,id",
            "date_of_travel" => "sometimes|date",
            "booked_date" => "sometimes|date"
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $message = config('settings.message.validation_fail');
            return $apiResponseHelper::returnError("VALIDATION_ERROR", Response::HTTP_BAD_REQUEST, $message, $validator->errors()->messages());
        }

        return $this->updateModelData($validator, $booking, $apiResponseHelper);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $uuid
     * @param ApiResponseHelper $apiResponseHelper
     * @return JsonResponse
     */
    public function destroy($uuid, ApiResponseHelper $apiResponseHelper): JsonResponse
    {
        $booking = Booking::findOrFail($uuid);
        return $this->softDeleteModelData($booking, $apiResponseHelper);
    }

    public function changeStatus(StatusRequest $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $booking = Booking::findOrFail($id);
            $booking->travel_status = $request->travel_status;
            $car = $this->carStatusChange($booking, $request->travel_status);
            $car->update();
            $booking->save();
            DB::commit();

            $result['message'] = config('settings.message.status_changed');
            return response()->json($result, Response::HTTP_OK);
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    private function setLatAndLngInRequest(Request $request, LocationService $locationService)
    {
        if(isset($request->pickup_location)){
            $pickup_latlng = $locationService->getLatAndLngFromAddress($request->pickup_location);
            $request["pickup_lat"] = $pickup_latlng["latitude"];
            $request["pickup_lng"] = $pickup_latlng["longitude"];
        }
        if(isset($request->arrival_location)){
            $arrival_latlng = $locationService->getLatAndLngFromAddress($request->arrival_location);
            $request["arrival_lat"] = $arrival_latlng["latitude"];
            $request["arrival_lng"] = $arrival_latlng["longitude"];
        }

        return $request;
    }

    private function carStatusChange($booking, $travel_status)
    {
        //travel_status = ONGOING,BOOKED,FINISHED,PARKED
        //"car_status" => "INACTIVE,BUSY,BOOKED",
        $car = $booking->car;
        if ($travel_status == "BOOKED" || $travel_status == "PARKED") {
            $car->car_status = "BOOKED";
        } else if($travel_status == "ONGOING"){
            $car->car_status = "BUSY";
        } else {
            $car->car_status = "INACTIVE";
        }
        return $car;
    }
}
