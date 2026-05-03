<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Order;
use App\Models\Menu;
use App\Models\MenuAddon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'plan',
        'is_active',
        'order_limit',
        'store_name',
        'store_phone',
        'store_address',
        'invoice_footer',
        'invoice_template'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function addons()
    {
        return $this->hasMany(MenuAddon::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
