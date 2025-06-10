<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'status',
        'total',
        'freight',
        'subtotal',
        'coupon_id',
        'cep'
    ];

    protected $casts = [
        'status' => 'string',
        'total' => 'decimal:2',
        'freight' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
