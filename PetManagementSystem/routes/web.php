<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'index']);

Route::get('/pets/create', [PetController::class, 'create']);

ROute::get('/pets/{id}', [PetController::class, 'show']);

Route::post('/pets', [PetController::class, 'store']);