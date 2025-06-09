<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stock;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(Request $request) {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $freight = $this->calcFrete($subtotal);
        $total = $subtotal + $freight;

        $order = Order::create([
            'subtotal' => $subtotal,
            'freight' => $freight,
            'total' => $total,
            'cep' => $request->cep
        ]);

        foreach ($cart as $item) {
            Stock::where('product_id', $item['product_id'])
                 ->where('variation', $item['variation'])
                 ->decrement('quantity', $item['quantity']);
        }

        session()->forget('cart');
        return redirect()->back()->with('success', 'Pedido realizado!');
    }

    private function calcFrete($subtotal) {
        if ($subtotal > 200) return 0;
        if ($subtotal >= 52 && $subtotal <= 166.59) return 15;
        return 20;
    }

    public function calculateFreight($subtotal)
    {
        if ($subtotal > 200) return 0;
        if ($subtotal >= 52 && $subtotal <= 166.59) return 15.00;
        return 20.00;
    }


}
