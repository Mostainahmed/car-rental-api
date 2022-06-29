<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\CarResource;
use App\Http\Resources\FuelPolicyResource;
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

class CarController extends BaseController
{
    public $car;
    public function __construct()
    {
        $this->car = new Car;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return CarResource::collection($this->car->getCars($request));
    }

    /**
     * Display a specific resource.
     *
     * @return CarResource
     */
    public function show($id){
        return new CarResource(Car::find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Car $car
     * @param ApiResponseHelper $apiResponseHelper
     * @param LocationService $locationService
     * @return JsonResponse
     */
    public function store(Request $request, Car $car, ApiResponseHelper $apiResponseHelper, LocationService $locationService): JsonResponse
    {
        $rules = array(
            'title' => 'required|string',
            "transmission" => "required|string|in:AUTO,MANUAL",
            "brand_id" => "required|exists:brands,id",
            "car_type_id" => "required|exists:car_types,id",
            "supplier_id" => "required|exists:suppliers,id",
            "status" => "required|string|in:INACTIVE,BUSY,BOOKED",
            "location" => "required|string"
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
            $car = Car::create($input);
            DB::commit();

            $message = config('settings.message.saved');
            return $apiResponseHelper::returnSuccess($message, $car, Response::HTTP_CREATED);
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
        $car = Car::find($uuid);
        if (!$car) {
            $message = config('settings.message.not_found');
            return $apiResponseHelper::returnError("NOT_FOUND", Response::HTTP_NOT_FOUND, null, $message);
        }
        $rules = array(
            'title' => 'sometimes|string',
            "transmission" => "sometimes|string|in:AUTO,MANUAL",
            "brand_id" => "sometimes|exists:brands,id",
            "car_type_id" => "sometimes|exists:car_types,id",
            "supplier_id" => "sometimes|exists:suppliers,id",
            "status" => "sometimes|string|in:INACTIVE,BUSY,BOOKED",
            "location" => "sometimes|string"
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $message = config('settings.message.validation_fail');
            return $apiResponseHelper::returnError("VALIDATION_ERROR", Response::HTTP_BAD_REQUEST, $message, $validator->errors()->messages());
        }

        return $this->updateModelData($validator, $car, $apiResponseHelper);
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
        $car = Car::findOrFail($uuid);
        return $this->softDeleteModelData($car, $apiResponseHelper);
    }

    private function setLatAndLngInRequest(Request $request, LocationService $locationService)
    {
        $result = $locationService->getLatAndLngFromAddress($request->location);
        $request["current_lat"] = $result["latitude"];
        $request["current_lng"] = $result["longitude"];
        return $request;
    }
}
