<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('type-animal', [AnimalController::class, 'getQuantityTypeAnimal']);