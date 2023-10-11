<?php

use App\Http\Controllers\Admin\AirportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/verify-token', [AuthController::class, 'verify'])->middleware('auth:sanctum');

Route::get('/home/{departure}', [HomeController::class, 'home']);
Route::get('/flights/{departure}/{destination}', [HomeController::class, 'flights']);
Route::get('/flight/details/{id}', [HomeController::class, 'details']);

Route::post('/flight/reserve', [HomeController::class, 'reserve'])->middleware('auth:sanctum');

Route::get('/airports/{search}', [HomeController::class, 'airportList']);

//ADMIN
//api/airports/{airport}
Route::apiResource('airports', AirportController::class)->middleware('auth:sanctum');

