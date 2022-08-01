<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\BokingController;
use App\Http\Controllers\API\LapanganController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

// tidak perlu login dengan barear access token untuk mengakses :
Route::group(['prefix' => 'v1'], function ($router) {

    // untuk tabel customer
    Route::get('customer', [CustomerController::class, 'index']);
    Route::get('customer/{id}', [CustomerController::class, 'show']);
    // untuk tabel boking
    Route::get('boking', [BokingController::class, 'index']);
    Route::get('boking/{id}', [BokingController::class, 'show']);
    // untuk tabel lapangan
    Route::get('lapangan', [LapanganController::class, 'index']);
    Route::get('lapangan/{id}', [LapanganController::class, 'show']);
 
});

// setelah login dengan barear access token
    Route::group(['middleware'=>'auth:api','prefix' => 'v1'], function ($router) {

    // CRUD untuk tabel customer
    Route::post('customer', [CustomerController::class, 'store']);
    Route::put('customer/{id}', [CustomerController::class, 'update']);
    Route::delete('customer/{id}', [CustomerController::class, 'destroy']);
    // CRUD untuk tabel boking
    Route::post('boking', [BokingController::class, 'store']);
    Route::put('boking/{id}', [BokingController::class, 'update']);
    Route::delete('boking/{id}', [BokingController::class, 'destroy']);
    // CRUD untuk tabel lapangan
    Route::post('lapangan', [LapanganController::class, 'store']);
    Route::put('lapangan/{id}', [LapanganController::class, 'update']);
    Route::delete('lapangan/{id}', [LapanganController::class, 'destroy']);

    //tes relasi antar tabel
    Route::get('lapanganR', [LapanganController::class, 'lapanganRelasi']);
    //tes relasi antar tabel
    Route::get('bokingR', [BokingController::class, 'bokingRelasi']);
    // tes relasi antar tabel
    Route::get('customerR', [CustomerController::class, 'customerRelasi']);

});

Route::group(['middleware' => 'api'], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::get('password', function () {
        return bcrypt('tokikatok');
    });
});