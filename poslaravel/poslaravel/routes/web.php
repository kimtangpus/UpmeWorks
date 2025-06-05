<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PosController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';



Route::get('/', function () {
    return Inertia::render('Pos');
})->name('Pos');

Route::get('/show-orders', function () {
    return Inertia::render('ShowAllTables');
})->name('show-orders');




Route::get('/', [PosController::class, 'index']);
