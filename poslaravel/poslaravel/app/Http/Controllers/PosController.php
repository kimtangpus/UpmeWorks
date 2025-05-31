<?php

namespace App\Http\Controllers;

use App\Models\PosCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PosController extends Controller
{
   public function index()
{
    $categories = PosCategory::with('menus')->get();

    // Debug: check if data exists
    logger($categories->toArray());

    return Inertia::render('Pos', [
        'categories' => $categories
    ]);
}
}
