<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\ProducerController;
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

Route::prefix('/users')->group(function () {

    Route::get('', [UserController::class, 'getAll']);

    Route::middleware('validate.id')->get('/{id}', [UserController::class, 'getById']);

    Route::post('', [UserController::class, 'post']);

    Route::middleware('validate.id')->delete('/{id}', [UserController::class, 'delete']);

    Route::middleware('validate.id')->patch('/{id}', [UserController::class, 'update']);

    Route::middleware('validate.id')->get('/{id}/rol', [UserController::class, 'rol']);

    Route::middleware('validate.id')->get('/{id}/calendar', [UserController::class, 'calendar']);
});

Route::prefix('/calendars')->group(function () {


    Route::get('', [CalendarController::class, 'getAll']);

    Route::middleware('validate.id')->get('/{id}', [CalendarController::class, 'getById']);

    Route::post('', [CalendarController::class, 'post']);

    Route::middleware('validate.id')->delete('/{id}', [CalendarController::class, 'delete']);

    Route::middleware('validate.id')->patch('/{id}', [CalendarController::class, 'update']);


    Route::middleware('validate.id')->get('/{id}/user', [CalendarController::class, 'user']);
});

Route::prefix('/actors')->group(function () {
    Route::get('', [ActorController::class, 'getAll']);
    Route::middleware('validate.id')->get('/{id}', [ActorController::class, 'getById']);
    Route::middleware('validate.id')->get('/{id}/characters', [ActorController::class, 'characters']);
    Route::middleware('validate.id')->get('/{id}/microphone', [ActorController::class, 'microphone']);
    Route::post('', [ActorController::class, 'post']);
    Route::middleware('validate.id')->delete('/{id}', [ActorController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [ActorController::class, 'update']);
});

Route::prefix('/characters')->group(function () {
    Route::get('', [CharacterController::class, 'getAll']);
    Route::middleware('validate.id')->get('/{id}', [CharacterController::class, 'getById']);
    Route::middleware('validate.id')->get('/{id}/actor', [CharacterController::class, 'actor']);
    Route::post('', [CharacterController::class, 'post']);
    Route::middleware('validate.id')->delete('/{id}', [CharacterController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [CharacterController::class, 'update']);
});

Route::prefix('/animes')->group(function () {
    Route::get('', [AnimeController::class, 'getAll']);
    Route::middleware('validate.id')->get('/{id}', [AnimeController::class, 'getById']);
    Route::middleware('validate.id')->get('/{id}/producer', [AnimeController::class, 'producer']);
    Route::post('', [AnimeController::class, 'post']);
    Route::middleware('validate.id')->delete('/{id}', [AnimeController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [AnimeController::class, 'update']);
});

Route::prefix('/producers')->group(function () {
    Route::get('', [ProducerController::class, 'getAll']);
    Route::middleware('validate.id')->get('/{id}', [ProducerController::class, 'getById']);
    Route::middleware('validate.id')->get('/{id}/animes', [ProducerController::class, 'animes']);
    Route::post('', [ProducerController::class, 'post']);
    Route::middleware('validate.id')->delete('/{id}', [ProducerController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [ProducerController::class, 'update']);
});

Route::prefix('/petitions')->group(function () {
    Route::get('', [PetitionController::class, 'getAll']);
    Route::middleware('validate.id')->get('/{id}', [PetitionController::class, 'getById']);
    Route::post('', [PetitionController::class, 'post']);
    Route::middleware('validate.id')->delete('/{id}', [PetitionController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [PetitionController::class, 'update']);
});


Route::post('/login',[LoginController::class,'login']);


Route::middleware('login')->get('/logout',[LoginController::class,'logout']);


Route::post('/create',[LoginController::class,'crearUser']);

Route::middleware('login')->get('/me',[LoginController::class,'whoAmI']);
