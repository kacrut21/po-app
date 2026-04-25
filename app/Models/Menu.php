<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'category',
        'selling_price',
        'hpp',
        'margin',
        'image',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'menu_ingredients')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}