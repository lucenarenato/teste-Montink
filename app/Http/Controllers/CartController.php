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

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variation' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        // Identificador único para cada variação
        $key = "{$request->product_id}-{$request->variation}";

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity;
        } else {
            $cart[$key] = [
                'product_id' => $request->product_id,
                'variation' => $request->variation,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

}
