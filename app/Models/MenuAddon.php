<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuAddon extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price'     => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItemAddons()
    {
        return $this->hasMany(OrderItemAddon::class);
    }
}
