<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BrandController extends BaseController
{
    public $brand;
    public function __construct()
    {
        $this->brand = new Brand;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return BrandResource::collection($this->brand->getBrands($request));
    }

    /**
     * Display a specific resource.
     *
     * @return BrandResource
     */
    public function show($id){
        return new BrandResource(Brand::find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Brand $brand
     * @param ApiResponseHelper $apiResponseHelper
     * @return JsonResponse
     */
    public function store(Request $request, Brand $brand, ApiResponseHelper $apiResponseHelper): JsonResponse
    {
        $rules = array(
            'title' => 'required|string',
            'logo' => 'sometimes|string',
            'url' => 'sometimes|string'
        );

        $validatorBrand = Validator::make($request->all(), $rules);

        if ($validatorBrand->fails()) {
            $message = config('settings.message.validation_fail');
            return $apiResponseHelper::returnError("VALIDATION_ERROR", Response::HTTP_BAD_REQUEST, $message, $validatorBrand->errors()->messages());
        }

        return $this->storeModelData($validatorBrand, $brand, $apiResponseHelper);
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
        $brand = Brand::find($uuid);
        if (!$brand) {
            $message = config('settings.message.not_found');
            return $apiResponseHelper::returnError("NOT_FOUND", Response::HTTP_NOT_FOUND, null, $message);
        }
        $rulesBrand = array(
            'title' => 'sometimes|string',
            'logo' => 'sometimes|string',
            'url' => 'sometimes|string'
        );

        $validatorBrand = Validator::make($request->all(), $rulesBrand);

        if ($validatorBrand->fails()) {
            $message = config('settings.message.validation_fail');
            return $apiResponseHelper::returnError("VALIDATION_ERROR", Response::HTTP_BAD_REQUEST, $message, $validatorBrand->errors()->messages());
        }

        return $this->updateModelData($validatorBrand, $brand, $apiResponseHelper);
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
        $brand = Brand::findOrFail($uuid);
        return $this->softDeleteModelData($brand, $apiResponseHelper);
    }
}
