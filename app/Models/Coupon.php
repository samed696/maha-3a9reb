<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'min_purchase',
        'usage_limit',
        'expires_at',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
        'min_purchase' => 'decimal:2',
        'value' => 'decimal:2'
    ];

    /**
     * Calculate the discount amount based on the subtotal.
     *
     * @param float $subtotal
     * @return float
     */
    public function calculateDiscount($subtotal)
    {
        if ($this->type === 'fixed') {
            return min($this->value, $subtotal);
        } elseif ($this->type === 'percent') {
            return $subtotal * ($this->value / 100);
        }
        return 0;
    }
}
