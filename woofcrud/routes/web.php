<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{pathMatch}', function() {
    return view('welcome');
})->where('pathMatch', '.*');


Route::get('/dogs/create', [DogController::class, 'create']); // for rendering the form
Route::post('/dogs', [DogController::class, 'store']); // for handling the form submission
