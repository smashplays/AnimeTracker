<?php

use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarController;
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



Route::prefix('/users')->group(function () {

    Route::get('',[UserController::class,'getAll']);

    Route::middleware('validate.id')->get('/{id}',[UserController::class,'getById']);

    Route::post('',[UserController::class,'post']);

    Route::middleware('validate.id')->delete('/{id}',[UserController::class,'delete']);

    Route::middleware('validate.id')->patch('/{id}',[UserController::class,'update']);

});

Route::prefix('/rols')->group(function () {

    Route::get('',[RolController::class,'getAll']);

    Route::middleware('validate.id')->get('/{id}',[RolController::class,'getById']);

    Route::post('',[RolController::class,'post']);

    Route::middleware('validate.id')->delete('/{id}',[RolController::class,'delete']);

    Route::middleware('validate.id')->patch('/{id}',[RolController::class,'update']);

});

Route::prefix('/calendars')->group(function () {


    Route::get('',[CalendarController::class,'getAll']);

    Route::middleware('validate.id')->get('/{id}',[CalendarController::class,'getById']);

    Route::post('',[CalendarController::class,'post']);

    Route::middleware('validate.id')->delete('/{id}',[CalendarController::class,'delete']);

    Route::middleware('validate.id')->patch('/{id}',[CalendarController::class,'update']);

});

