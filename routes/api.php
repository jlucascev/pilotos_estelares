<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NaveController;
use App\Http\Controllers\PilotoController;

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

Route::prefix('naves')->group(function () {
	Route::post('/crear',[NaveController::class,"crearNave"]);
	Route::post('/modificar/{id}',[NaveController::class,"modificarNave"]);
	Route::post('/borrar/{id}',[NaveController::class,"borrarNave"]);
	Route::get('/consultar/{id}',[NaveController::class,"verNave"]);
	Route::get('/',[NaveController::class,"listarNaves"]);
	Route::get('/filtrar',[NaveController::class,"listarNavesFiltro"]);
});

Route::prefix('pilotos')->group(function () {
	Route::post('/crear',[PilotoController::class,"crearPiloto"]);
	Route::post('/modificar/{id}',[PilotoController::class,"modificarPiloto"]);
	Route::post('/borrar/{id}',[PilotoController::class,"borrarPiloto"]);
});