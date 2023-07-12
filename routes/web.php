<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/cuentas', function () {
    return view('cuenta.cuenta');
})->name('cuentas');

Route::middleware(['auth:sanctum', 'verified'])->get('/movimientos', function () {
    return view('movimiento.movimiento');
})->name('movimientos');

Route::get('/fire', function () {
    return "hola";
})->name('fire');



