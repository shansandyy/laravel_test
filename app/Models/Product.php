<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    public function favorite_user()
    {
        return $this->belongsToMany(User::class, 'favorites',  'product_id');
    }
}
