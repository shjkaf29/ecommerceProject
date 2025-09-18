<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = [
        'product_title',
        'product_description',
        'product_quantity',
        'product_price',
        'product_image',
        'product_category',
    ];

    
    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category');
    }
}
