<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'featured',
        'available',
        'preparation_time'
    ];

    /**
     * Get the category that owns the menu item.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the order items for the menu item.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
