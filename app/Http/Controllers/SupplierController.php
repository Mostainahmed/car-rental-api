<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends BaseController
{
    public $supplier;
    public function __construct()
    {
        $this->supplier = new Supplier;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return SupplierResource::collection($this->supplier->getSuppliers($request));
    }

    /**
     * Display a specific resource.
     *
     * @return SupplierResource
     */
    public function show($id){
        return new SupplierResource(Supplier::find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Supplier $supplier
     * @param ApiResponseHelper $apiResponseHelper
     * @return JsonResponse
     */
    public function store(Request $request, Supplier $supplier, ApiResponseHelper $apiResponseHelper): JsonResponse
    {
        $rules = array(
            'title' => 'required|string',
            'description' => 'sometimes|string'
        );

        $validatorSupplier = Validator::make($request->all(), $rules);

        if ($validatorSupplier->fails()) {
            $message = config('settings.message.validation_fail');
            return $apiResponseHelper::returnError("VALIDATION_ERROR", Response::HTTP_BAD_REQUEST, $message, $validatorSupplier->errors()->messages());
        }

        return $this->storeModelData($validatorSupplier, $supplier, $apiResponseHelper);
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
        $supplier = Supplier::find($uuid);
        if (!$supplier) {
            $message = config('settings.message.not_found');
            return $apiResponseHelper::returnError("NOT_FOUND", Response::HTTP_NOT_FOUND, null, $message);
        }
        $rulesSupplier = array(
            'title' => 'sometimes|string',
            'description' => 'sometimes|string'
        );

        $validatorSupplier = Validator::make($request->all(), $rulesSupplier);

        if ($validatorSupplier->fails()) {
            $message = config('settings.message.validation_fail');
            return $apiResponseHelper::returnError("VALIDATION_ERROR", Response::HTTP_BAD_REQUEST, $message, $validatorSupplier->errors()->messages());
        }

        return $this->updateModelData($validatorSupplier, $supplier, $apiResponseHelper);
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
        $supplier = Supplier::findOrFail($uuid);
        return $this->softDeleteModelData($supplier, $apiResponseHelper);
    }
}
