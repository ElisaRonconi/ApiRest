<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RandomUserController;

//Route::get('/', [UserController::class, 'index']);
Route::get('/', [UserController::class, 'randomUser']);
Route::post('/generar-usuarios', [RandomUserController::class, 'generar'])->name('generar.usuarios');
