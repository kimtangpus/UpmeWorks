<?php

use App\Http\Controllers\DogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/dogs', [DogController::class, 'store']);
Route::get('/dogs', [DogController::class, 'index']);
Route::get('/dogs/{product}/edit', [DogController::class, 'edit']);
Route::post('/dogs', [DogController::class, 'store']);
Route::put('/dogs/{product}', [DogController::class, 'update']);
Route::delete('/dogs/{id}', [DogController::class, 'destroy']);
