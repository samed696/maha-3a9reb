<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'type', 'value', 'expiry_date', '_token'
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
