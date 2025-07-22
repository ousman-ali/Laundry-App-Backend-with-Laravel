<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    protected $fillable = [
        'name',
        'stock',
        'min_stock',
        'unit_price'
        'unit',
    ];
}
