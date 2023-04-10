<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class,'order_products','order_id','product_id')->withPivot('quantity');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    // public function orderDetails()
    // {
    //     return $this->belongsTo(OrderProduct::class,'order_id');
    // }
}
