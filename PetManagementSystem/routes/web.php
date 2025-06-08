<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;

/* Pet */

Route::get('/', [PetController::class, 'index']);

Route::get('/pets/create', [PetController::class, 'create'])->middleware('auth');

ROute::get('/dashboard', [PetController::class, 'dashboard']);

Route::post('/pets', [PetController::class, 'store']);

Route::delete('/pets/{id}', [PetController::class, 'destroy'])->middleware('auth');

Route::get('/pets/edit/{id}', [PetController::class, 'edit'])->middleware('auth');

Route::put('/pets/update/{id}', [PetController::class, 'update'])->middleware('auth');

/* Appointment */

Route::get('/appointment/create', [AppointmentController::class, 'create'])->middleware('auth');

/* User */

Route::get('/users', [UserController::class, 'dashboard']);

Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth');

Route::get('/users/edit/{id}', [UserController::class, 'edit'])->middleware('auth');

Route::put('users/update/{id}', [UserController::class, 'update'])->middleware('auth');
