<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\FuelPolicyResource;
use App\Models\FuelPolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class FuelPolicyController extends BaseController
{
    public $fuelPolicy;
    public function __construct()
    {
        $this->fuelPolicy = new FuelPolicy;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return FuelPolicyResource::collection($this->fuelPolicy->getFuelPolicies($request));
    }

    /**
     * Display a specific resource.
     *
     * @return FuelPolicyResource
     */
    public function show($id){
        return new FuelPolicyResource(FuelPolicy::find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param FuelPolicy $fuelPolicy
     * @param ApiResponseHelper $apiResponseHelper
     * @return JsonResponse
     */
    public function store(Request $request, FuelPolicy $fuelPolicy, ApiResponseHelper $apiResponseHelper): JsonResponse
    {
        $rules = array(
            'title' => 'required|string',
            'distance' => 'sometimes',
            'distance_unit' => 'sometimes|in:kilometer,mile',
            'cost' => 'sometimes',
            'cost_unit' => 'sometimes|in:euro,dollar'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $message = config('settings.message.validation_fail');
            return $apiResponseHelper::returnError("VALIDATION_ERROR", Response::HTTP_BAD_REQUEST, $message, $validator->errors()->messages());
        }

        return $this->storeModelData($validator, $fuelPolicy, $apiResponseHelper);
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
        $fuelPolicy = FuelPolicy::find($uuid);
        if (!$fuelPolicy) {
            $message = config('settings.message.not_found');
            return $apiResponseHelper::returnError("NOT_FOUND", Response::HTTP_NOT_FOUND, null, $message);
        }
        $rules = array(
            'title' => 'sometimes|string',
            'distance' => 'sometimes',
            'distance_unit' => 'sometimes|in:kilometer,mile',
            'cost' => 'sometimes',
            'cost_unit' => 'sometimes|in:euro,dollar'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $message = config('settings.message.validation_fail');
            return $apiResponseHelper::returnError("VALIDATION_ERROR", Response::HTTP_BAD_REQUEST, $message, $validator->errors()->messages());
        }

        return $this->updateModelData($validator, $fuelPolicy, $apiResponseHelper);
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
        $fuelPolicy = FuelPolicy::findOrFail($uuid);
        return $this->softDeleteModelData($fuelPolicy, $apiResponseHelper);
    }
}
