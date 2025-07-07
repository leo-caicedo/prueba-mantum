<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('type-animal', [AnimalController::class, 'getQuantityTypeAnimal']);
Route::get('create-users', [UserController::class, 'createUser']);