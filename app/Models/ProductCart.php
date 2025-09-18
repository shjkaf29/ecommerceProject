<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    protected $table = 'product_carts';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
