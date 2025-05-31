<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosCategoryMenu extends Model
{
    protected $table = 'pos_category_menus';

    public function category()
    {
        return $this->belongsTo(PosCategory::class, 'pos_category_id');
    }
}
