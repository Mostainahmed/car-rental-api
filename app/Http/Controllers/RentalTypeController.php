<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\CarSpecificationResource;
use App\Http\Resources\FuelPolicyResource;
use App\Http\Resources\RentalTypeResource;
use App\Models\CarSpecification;
use App\Models\FuelPolicy;
use App\Models\RentalType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RentalTypeController extends BaseController
{
    public $rentalType;
    public function __construct()
    {
        $this->rentalType = new RentalType;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return RentalTypeResource::collection($this->rentalType->getRentalTypes($request));
    }

    /**
     * Display a specific resource.
     *
     * @param $id
     * @return RentalTypeResource
     */
    public function show($id): RentalTypeResource
    {
        return new RentalTypeResource(RentalType::find($id));
    }

    public function destroy($uuid, ApiResponseHelper $apiResponseHelper): JsonResponse
    {
        $rentalType = RentalType::findOrFail($uuid);
        return $this->softDeleteModelData($rentalType, $apiResponseHelper);
    }
}
