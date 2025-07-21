<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'ticket_number',
        'order_type',
        'total_price',
        'pickup_datetime',
        'status',
    ];

    // Order belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
