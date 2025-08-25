<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'email',
        'avatar',
        'rating',
        'comment',
        'approved'
    ];

    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that the review is for.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
