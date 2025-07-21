<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    protected $fillable = [
        'order_id',
        'item_name',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
