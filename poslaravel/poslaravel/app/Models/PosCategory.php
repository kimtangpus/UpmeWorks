<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PosCategoryMenu;

class PosCategory extends Model
{
    protected $table = 'pos_categories';

    public function menus()
    {
        return $this->hasMany(PosCategoryMenu::class, 'pos_category_id');
    }
}
