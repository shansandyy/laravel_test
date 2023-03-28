<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory;
    use SoftDeletes;


    // protected $fillable = [
    //     'quantity'
    // ];

    protected $guarded = [''];

    // protected $hidden = [
    //     'quantity'
    // ];

    protected $appends = [
        'total_price'
    ];

    public function getTotalPriceAttribute()
    {
        return $this->quantity * 100;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
