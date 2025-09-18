<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;

class UserOrder extends Model
{
    protected $table = 'user_orders';

    protected $fillable = [
        'user_id',
        'status',
    ];

    /**
     * The user who placed the order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Products associated with this order (via pivot table)
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
                    ->withPivot('quantity');
    }

    /**
     * Direct relation to order_items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'user_order_id');
    }
}
