<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'discount', 'min_subtotal', 'valid_until'];

    public function isValidFor($subtotal)
    {
        return $this->valid_until >= now() && $subtotal >= $this->min_subtotal;
    }
}
