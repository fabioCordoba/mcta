<?php

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

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

    Route::resource('cuentas', App\Http\Controllers\CuentaController::class);
    Route::get('/cuentas/search/{nombre}', [App\Http\Controllers\CuentaController::class, 'search']);

    Route::resource('movimientos', App\Http\Controllers\MovimientoController::class);
    Route::get('/movimientos/search/{nombre}', [App\Http\Controllers\MovimientoController::class, 'search']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




