<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarSpecificationController;
use App\Http\Controllers\CarTypeController;
use App\Http\Controllers\FuelPolicyController;
use App\Http\Controllers\RentalTypeController;
use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1/'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('user_register');
    Route::post('/login', [AuthController::class, 'login'])->name('user_login');
    Route::group(['prefix' => 'car-types/', 'middleware' => 'auth:sanctum'], function () {
        Route::get('/', [CarTypeController::class, 'index'])->name('list_of_car_types');
        Route::get('/{uuid}', [CarTypeController::class, 'show'])->name('detail_of_car_type');
        Route::post('/', [CarTypeController::class, 'store'])->name('store_car_type');
        Route::put('/{uuid}', [CarTypeController::class, 'update'])->name('update_car_type');
        Route::delete('/{uuid}', [CarTypeController::class, 'destroy'])->name('delete_car_type');
    });
    Route::group(['prefix' => 'brands/', 'middleware' => 'auth:sanctum'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('listof-brands');
        Route::get('/{uuid}', [BrandController::class, 'show'])->name('detail_of_brands');
        Route::post('/', [BrandController::class, 'store'])->name('store_car_brands');
        Route::put('/{uuid}', [BrandController::class, 'update'])->name('update_car_brands');
        Route::delete('/{uuid}', [BrandController::class, 'destroy'])->name('delete_car_brands');
    });
    Route::group(['prefix' => 'suppliers/', 'middleware' => 'auth:sanctum'], function () {
        Route::get('/', [SupplierController::class, 'index'])->name('list_of_suppliers');
        Route::get('/{uuid}', [SupplierController::class, 'show'])->name('detail_of_suppliers');
        Route::post('/', [SupplierController::class, 'store'])->name('store_car_suppliers');
        Route::put('/{uuid}', [SupplierController::class, 'update'])->name('update_car_suppliers');
        Route::delete('/{uuid}', [SupplierController::class, 'destroy'])->name('delete_car_suppliers');
    });
    Route::group(['prefix' => 'fuel-policies/', 'middleware' => 'auth:sanctum'], function () {
        Route::get('/', [FuelPolicyController::class, 'index'])->name('list_of_fuel_policies');
        Route::get('/{uuid}', [FuelPolicyController::class, 'show'])->name('detail_of_fuel_policies');
        Route::post('/', [FuelPolicyController::class, 'store'])->name('store_car_fuel_policies');
        Route::put('/{uuid}', [FuelPolicyController::class, 'update'])->name('update_car_fuel_policies');
        Route::delete('/{uuid}', [FuelPolicyController::class, 'destroy'])->name('delete_car_fuel_policies');
    });

    Route::group(['prefix' => 'car-specs/', 'middleware' => 'auth:sanctum'], function () {
        Route::get('/', [CarSpecificationController::class, 'index'])->name('list_of_car_specs');
        Route::get('/{uuid}', [CarSpecificationController::class, 'show'])->name('detail_of_car_specs');
        Route::delete('/{uuid}', [CarSpecificationController::class, 'destroy'])->name('delete_car_specs');
    });

    Route::group(['prefix' => 'rental-types/', 'middleware' => 'auth:sanctum'], function () {
        Route::get('/', [RentalTypeController::class, 'index'])->name('list_of_rental_types');
        Route::get('/{uuid}', [RentalTypeController::class, 'show'])->name('detail_of_rental_types');
        Route::delete('/{uuid}', [RentalTypeController::class, 'destroy'])->name('delete_rental_types');
    });
});
