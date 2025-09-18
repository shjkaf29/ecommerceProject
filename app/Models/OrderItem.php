<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
     protected $table = 'order_items';

    protected $fillable = [
        'user_order_id',
        'product_id',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(UserOrder::class, 'user_order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
