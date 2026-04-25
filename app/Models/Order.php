<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'customer_name',
        'customer_phone',
        'order_date',
        'delivery_date',
        'event_type',
        'pickup_method',
        'delivery_address',
        'subtotal',
        'shipping_fee',
        'total_amount',
        'down_payment',
        'payment_status',
        'payment_method',
        'order_status',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
