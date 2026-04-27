<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemAddon extends Model
{
    protected $fillable = [
        'order_item_id',
        'menu_addon_id',
        'price',
    ];

    protected $casts = [
        'price' => 'integer',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function menuAddon()
    {
        return $this->belongsTo(MenuAddon::class);
    }
}
