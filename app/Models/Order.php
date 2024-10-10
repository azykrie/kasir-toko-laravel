<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_order',
        'name_cashier',
        'grand_total',
        'pay',
        'change'
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
