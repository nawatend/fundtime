<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    protected $table = 'shop_items';

    protected $fillable = [
        'type',
        'total_f',
        'real_cost_euro',
    ];
}
