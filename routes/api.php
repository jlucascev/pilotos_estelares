<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NaveController;
use App\Http\Controllers\PilotoController;
use App\Http\Controllers\MisionController;
use App\Http\Controllers\MecanicoController;
use App\Http\Controllers\ReparacionController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->prefix('naves')->group(function () {
	Route::post('/crear',[NaveController::class,"crearNave"]);
	Route::post('/modificar/{id}',[NaveController::class,"modificarNave"]);
	Route::post('/borrar/{id}',[NaveController::class,"borrarNave"]);
	Route::get('/consultar/{id}',[NaveController::class,"verNave"]);
	Route::get('/',[NaveController::class,"listarNaves"]);
	Route::get('/filtrar',[NaveController::class,"listarNavesFiltro"]);
});

Route::middleware('auth:api')->prefix('pilotos')->group(function () {
	Route::post('/crear',[PilotoController::class,"crearPiloto"]);
	Route::post('/modificar/{id}',[PilotoController::class,"modificarPiloto"]);
	Route::post('/borrar/{id}',[PilotoController::class,"borrarPiloto"]);
	Route::get('/consultar/{id}',[PilotoController::class,"verPiloto"]);
});

Route::middleware('auth:api')->prefix('misiones')->group(function () {
	Route::post('/crear',[MisionController::class,"crearMision"]);
	Route::get('/consultar/{id}',[MisionController::class,"verMision"]);
});

Route::middleware('auth:api')->prefix('mecanicos')->group(function () {
	Route::post('/crear',[MecanicoController::class,"crearMecanico"]);
	Route::post('/modificar/{id}',[MecanicoController::class,"modificarMecanico"]);
	Route::post('/borrar/{id}',[MecanicoController::class,"borrarMecanico"]);
	Route::get('/',[MecanicoController::class,"listarMecanicos"]);
	Route::get('/consultar/{parametro}/{valor}',[MecanicoController::class,"verMecanico"]);
});

Route::middleware('auth:api')->prefix('reparaciones')->group(function () {
	Route::post('/crear',[ReparacionController::class,"crearReparacion"]);
	Route::get('/consultar/{id}',[ReparacionController::class,"verReparacion"]);
});

Route::prefix('usuarios')->group(function () {
	Route::post('/registrar',[UserController::class,"register"]);
	Route::post('/login',[UserController::class,"login"]);
});

