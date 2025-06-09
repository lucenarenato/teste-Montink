<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $cart = session()->get('cart', []);
        $key = $request->product_id . '-' . $request->variation;

        $cart[$key] = [
            'product_id' => $request->product_id,
            'variation' => $request->variation,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ];

        session()->put('cart', $cart);
        return back()->with('success', 'Adicionado ao carrinho!');
    }

}
