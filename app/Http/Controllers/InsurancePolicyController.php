<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\CarSpecificationResource;
use App\Http\Resources\FuelPolicyResource;
use App\Http\Resources\InsurancePolicyResource;
use App\Http\Resources\RentalTypeResource;
use App\Models\CarSpecification;
use App\Models\FuelPolicy;
use App\Models\InsurancePolicy;
use App\Models\RentalType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class InsurancePolicyController extends BaseController
{
    public $insurancePolicy;
    public function __construct()
    {
        $this->insurancePolicy = new InsurancePolicy;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return InsurancePolicyResource::collection($this->insurancePolicy->getInsurancePolicies($request));
    }

    /**
     * Display a specific resource.
     *
     * @param $id
     * @return InsurancePolicyResource
     */
    public function show($id): InsurancePolicyResource
    {
        return new InsurancePolicyResource(InsurancePolicy::find($id));
    }

    public function destroy($uuid, ApiResponseHelper $apiResponseHelper): JsonResponse
    {
        $insurancePolicy = InsurancePolicy::findOrFail($uuid);
        return $this->softDeleteModelData($insurancePolicy, $apiResponseHelper);
    }
}
