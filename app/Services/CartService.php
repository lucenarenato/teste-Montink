<?php

namespace App\Services;

use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartService
{
    public static function getCart()
    {
        return session('cart', []);
    }

    public static function calculateSubtotal($cart)
    {
        return collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public static function applyCoupon($couponCode, $subtotal)
    {
        $coupon = Coupon::where('code', $couponCode)->first();

        if ($coupon && $coupon->isValidFor($subtotal)) {
            return ['coupon' => $coupon, 'discount' => $coupon->discount];
        }

        return ['coupon' => null, 'discount' => 0];
    }
}
