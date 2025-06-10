<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function checkoutForm()
    {
        $cart = session('cart', []);
        return view('orders.checkout', compact('cart'));
    }

    public function checkout(Request $request)
    {
        $request->validate(['cep' => 'required']);

        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $coupon = null;
        $discount = 0;

        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();

            if ($coupon && $coupon->isValidFor($subtotal)) {
                $discount = $coupon->discount;
            }
        }

        $freight = $this->calcFrete($subtotal - $discount);
        $total = $subtotal + $freight - $discount;

        $order = Order::create([
            'subtotal' => $subtotal,
            'freight' => $freight,
            'total' => $total,
            'cep' => $request->cep,
            'coupon_code' => $coupon?->code,
            'discount' => $discount,
            'status' => 'pendente',
            'email' => $request->email,
        ]);

        foreach ($cart as $item) {
            Stock::where('product_id', $item['product_id'])
                 ->where('variation', $item['variation'])
                 ->decrement('quantity', $item['quantity']);
        }

        Mail::to($order->email)->send(new OrderCreated($order));

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

    public function checkCep(Request $request)
    {
        $cep = preg_replace('/[^0-9]/', '', $request->cep);
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
        return $response->json();
    }

}
