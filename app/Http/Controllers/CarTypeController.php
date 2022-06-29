<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\CarTypeResource;
use App\Models\CarType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CarTypeController extends BaseController
{
    public $carType;
    public function __construct()
    {
        $this->carType = new CarType;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return CarTypeResource::collection($this->carType->getCarTypes($request));
    }

    /**
     * Display a specific resource.
     *
     * @return CarTypeResource
     */
    public function show($id){
        return new CarTypeResource(CarType::find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(Request $request, CarType $carType, ApiResponseHelper $apiResponseHelper): JsonResponse
    {
        $rules = array(
            'title' => 'required|string'
        );

        $validatorCarType = Validator::make($request->all(), $rules);

        if ($validatorCarType->fails()) {
            $message = config('settings.message.validation_fail');
            return $apiResponseHelper::returnError("VALIDATION_ERROR", Response::HTTP_BAD_REQUEST, $message, $validatorCarType->errors()->messages());
        }

        return $this->storeModelData($validatorCarType, $carType, $apiResponseHelper);
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
        $carType = CarType::find($uuid);
        if (!$carType) {
            $message = config('settings.message.not_found');
            return $apiResponseHelper::returnError("NOT_FOUND", Response::HTTP_NOT_FOUND, null, $message);
        }
        $rulesPackage = array(
            'title' => 'sometimes|string'
        );

        $validatorCarType = Validator::make($request->all(), $rulesPackage);

        if ($validatorCarType->fails()) {
            $message = config('settings.message.validation_fail');
            return $apiResponseHelper::returnError("VALIDATION_ERROR", Response::HTTP_BAD_REQUEST, $message, $validatorCarType->errors()->messages());
        }

        return $this->updateModelData($validatorCarType, $carType, $apiResponseHelper);
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
        $carType = CarType::findOrFail($uuid);
        return $this->softDeleteModelData($carType, $apiResponseHelper);
    }
}
