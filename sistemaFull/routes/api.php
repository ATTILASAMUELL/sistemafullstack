<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


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

Route::post('/create',[ApiController::class,'createUsuario']);
Route::get('/listar',[ApiController::class,'listarUsuarios']);
Route::get('/lista/{id}',[ApiController::class,'listarUsuario']);
Route::post('/editar',[ApiController::class,'editarUsuario']);
Route::post('/editar/status/{id}',[ApiController::class,'editarStatus']);
Route::delete('/deletar/{id}',[ApiController::class,'deletarUsuario']);