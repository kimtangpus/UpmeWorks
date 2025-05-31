<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosCategory extends Model
{
    protected $table = 'pos_categories';

    public function menus()
    {
        return $this->hasMany(\App\Models\PosCategoryMenu::class, 'pos_category_id');
    }
}
