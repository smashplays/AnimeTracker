<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\MicrophoneController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/actors')->group(function () {
    Route::get('', [ActorController::class, 'getAll']);
    Route::middleware('validate.id')->get('/{id}', [ActorController::class, 'getById']);
    Route::middleware('validate.id')->get('/{id}/characters', [ActorController::class , 'characters']);
    Route::middleware('validate.id')->get('/{id}/microphone', [ActorController::class , 'microphone']);
    Route::post('', [ActorController::class, 'create']);
    Route::middleware('validate.id')->delete('/{id}', [ActorController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [ActorController::class, 'modify']); 
});

Route::prefix('/characters')->group(function () {
    Route::get('', [CharacterController::class, 'getAll']);
    Route::middleware('validate.id')->get('/{id}', [CharacterController::class, 'getById']);
    Route::middleware('validate.id')->get('/{id}/actor', [CharacterController::class , 'actor']);
    Route::post('', [CharacterController::class, 'create']);
    Route::middleware('validate.id')->delete('/{id}', [CharacterController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [CharacterController::class, 'modify']); 
});

Route::prefix('/microphones')->group(function () {
    Route::get('', [MicrophoneController::class, 'getAll']);
    Route::middleware('validate.id')->get('/{id}', [MicrophoneController::class, 'getById']);
    Route::middleware('validate.id')->get('/{id}/actor', [MicrophoneController::class , 'actor']);
    Route::post('', [MicrophoneController::class, 'create']);
    Route::middleware('validate.id')->delete('/{id}', [MicrophoneController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [MicrophoneController::class, 'modify']); 
});
