<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'order_number',
        'status',
        'total_amount',
        'payment_method',
        'payment_status',
        'note',
        'paid_at',
        'completed_at',
        'cancelled_at'
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order items for the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Generate a unique order number.
     */
    public static function generateOrderNumber()
    {
        $orderNumber = 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);
        
        while (self::where('order_number', $orderNumber)->exists()) {
            $orderNumber = 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);
        }
        
        return $orderNumber;
    }
}
