<?php

namespace App\Http\Controllers;

use App\Models\PosCategory;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;

class PosController extends Controller
{
   public function index()
{
    $categories = PosCategory::with(['menus'])->get();

    foreach ($categories as $category) {
        foreach ($category->menus as $menu) {
            if (!File::exists(public_path($menu->menu_image))) {
                $menu->menu_image = null;
            }
        }
    }

    return Inertia::render('Pos', [
        'categories' => $categories
    ]);
}
}
