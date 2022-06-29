<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarTypeController;
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
        Route::get('/', [CarTypeController::class, 'index'])->name('list-of-car-types');
        Route::get('/{uuid}', [CarTypeController::class, 'show'])->name('detail_of_car_type');
        Route::post('/', [CarTypeController::class, 'store'])->name('store_car_type');
        Route::put('/{uuid}', [CarTypeController::class, 'update'])->name('update_car_type');
        Route::delete('/{uuid}', [CarTypeController::class, 'destroy'])->name('delete_car_type');
    });
});
