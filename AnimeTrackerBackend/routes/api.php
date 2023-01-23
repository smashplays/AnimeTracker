<?php

use App\Http\Controllers\alumnadocontroller;
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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/

//Alumnos
Route::get('/alumnos', [alumnadocontroller::class, 'alumnos']);
Route::get('/alumnos/{id}', [alumnadocontroller::class, 'alumno'])->middleware('validarid');
Route::delete('/alumnos/{id}', [alumnadocontroller::class, 'borrar'])->middleware('validarid');
Route::post('/alumnos', [alumnadocontroller::class, 'crear']);
Route::put('/alumnos/{id}', [alumnadocontroller::class, 'editar'])->middleware('validarid');

//animes
Route::get('/animes', [animecontroller::class, 'animes']);
Route::get('/animes/{id}', [animecontroller::class, 'anime'])->middleware('validarid');
Route::delete('/animes/{id}', [animecontroller::class, 'borraranimes'])->middleware('validarid');
Route::post('/animes', [animecontroller::class, 'crearanimes']);
Route::put('/animes/{id}', [animecontroller::class, 'editaranimes'])->middleware('validarid');

//Productoras
Route::get('/productoras', [productorascontroller::class, 'productoras']);
Route::get('/productoras/{id}', [productorascontroller::class, 'productora'])->middleware('validarid');
Route::delete('/productoras/{id}', [productorascontroller::class, 'borrarproductoras'])->middleware('validarid');
Route::post('/productoras', [productorascontroller::class, 'crearproductoras']);
Route::put('/productoras/{id}', [productorascontroller::class, 'editarproductora'])->middleware('validarid');

//sedes
Route::get('/sede', [sedecontroller::class, 'sedes']);
Route::get('/sede/{id}', [sedecontroller::class, 'sede'])->middleware('validarid');
Route::delete('/sede/{id}', [sedecontroller::class, 'borrarsedes'])->middleware('validarid');
Route::post('/sede', [sedecontroller::class, 'crearsedes']);
Route::put('/sede/{id}', [sedecontroller::class, 'editarsedes'])->middleware('validarid');
