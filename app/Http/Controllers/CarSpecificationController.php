<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\CarSpecificationResource;
use App\Http\Resources\FuelPolicyResource;
use App\Models\CarSpecification;
use App\Models\FuelPolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CarSpecificationController extends BaseController
{
    public $carSpecification;
    public function __construct()
    {
        $this->carSpecification = new CarSpecification;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return CarSpecificationResource::collection($this->carSpecification->getCarSpecifications($request));
    }

    /**
     * Display a specific resource.
     *
     * @param $id
     * @return CarSpecificationResource
     */
    public function show($id): CarSpecificationResource
    {
        return new CarSpecificationResource(CarSpecification::find($id));
    }

    public function destroy($uuid, ApiResponseHelper $apiResponseHelper): JsonResponse
    {
        $carSpecification = CarSpecification::findOrFail($uuid);
        return $this->softDeleteModelData($carSpecification, $apiResponseHelper);
    }
}
