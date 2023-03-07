<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ChapterAnimeController;
use App\Http\Controllers\ChapterUserController;
use App\Http\Controllers\AnimeUserController;
use App\Http\Controllers\AnimeController;
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

    Route::middleware('validate.id')->get('/{id}/animes', [UserController::class, 'getByIdAnime']);
    Route::middleware('validate.id')->get('/{id}/chapters', [UserController::class, 'getChapterByUser']);
    Route::middleware('validate.id')->get('/{id}/chapters/{anime}', [UserController::class, 'getChapterByAnimeByUser']);

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





Route::prefix('/animes')->group(function () {
    Route::get('', [AnimeController::class, 'getAll']);
    Route::middleware('validate.id')->get('/{id}', [AnimeController::class, 'getById']);
    Route::post('', [AnimeController::class, 'post']);
    Route::middleware('validate.id')->delete('/{id}', [AnimeController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [AnimeController::class, 'update']);
});



Route::prefix('/chapters')->group(function () {
    Route::get('', [ChapterAnimeController::class, 'getAll']);
    Route::middleware('validate.id')->get('/anime/{id}', [ChapterAnimeController::class, 'getByIdAnime']);
    Route::middleware('validate.id')->get('/{id}', [ChapterAnimeController::class, 'getById']);
    Route::post('', [ChapterAnimeController::class, 'post']);
    Route::middleware('validate.id')->delete('/{id}', [ChapterAnimeController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [ChapterAnimeController::class, 'update']);
});



Route::prefix('/chapters-user')->group(function () {
    Route::get('', [ChapterUserController::class, 'getAll']);
    Route::middleware('validate.id')->get('/{id}', [ChapterUserController::class, 'getById']);
    Route::post('', [ChapterUserController::class, 'post']);
    Route::middleware('validate.id')->delete('/{id}', [ChapterUserController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [ChapterUserController::class, 'update']);
});


Route::prefix('/anime-user')->group(function () {
    Route::get('', [AnimeUserController::class, 'getAll']);
    Route::get('/{user}/anime/{anime}', [AnimeUserController::class, 'CheckAnimeandUser']);
    Route::middleware('validate.id')->get('/{id}', [AnimeUserController::class, 'getById']);
    Route::post('', [AnimeUserController::class, 'post']);
    Route::middleware('validate.id')->delete('/{id}', [AnimeUserController::class, 'delete']);
    Route::middleware('validate.id')->patch('/{id}', [AnimeUserController::class, 'update']);
});






Route::post('/login',[LoginController::class,'login']);


Route::middleware('login')->get('/logout',[LoginController::class,'logout']);


Route::post('/create',[LoginController::class,'crearUser']);

Route::middleware('login')->get('/me',[LoginController::class,'whoAmI']);
