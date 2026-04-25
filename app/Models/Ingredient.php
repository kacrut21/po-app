<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'unit',
        'price_per_unit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_ingredients')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
