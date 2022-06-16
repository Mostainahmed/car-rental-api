<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarTypeResource;
use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CarTypeController extends Controller
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
}
