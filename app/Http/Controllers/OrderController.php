<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Stock;
use App\Models\OrderItem;
use App\Models\Address;
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

        // $cart = session('cart', []);
        //$subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $subtotal = 0;
        $cartItems = $request->input('cart', []);

        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $coupon = null;
        $discount = 0;

        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();

            if ($coupon && $coupon->isValidFor($subtotal)) {
                $discount = $coupon->discount;
            }
        }

        $freight = $this->calculateFreight($subtotal - $discount);
        $total = $subtotal + $freight - $discount;

        $order = Order::create([
            'session_id' => session()->getId(),
            'subtotal' => $subtotal,
            'freight' => $freight,
            'total' => $total,
            'cep' => $request->cep,
            'coupon_code' => $coupon?->code,
            'discount' => $discount,
            'status' => 'AGUARDANDO_PAGAMENTO',
        ]);

        foreach ($cartItems as $item) {
            // Reduzir estoque
            Stock::where('product_id', $item['product_id'])
                 ->where('variation', $item['variation'])
                 ->decrement('quantity', $item['quantity']);

            // Registrar item do pedido
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'variation' => $item['variation'] ?? null,
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
            ]);
        }

        // Buscar dados do CEP na API
        $cep = preg_replace('/[^0-9]/', '', $request->input('cep'));
        $response = Http::get("https://viacep.com.br/ws/$cep/json/");

        if ($response->ok()) {
            $data = $response->json();

            $address = Address::create([
                'order_id' => $order->id,
                'cep' => $data['cep'] ?? null,
                'logradouro' => $data['logradouro'] ?? null,
                'complemento' => $data['complemento'] ?? null,
                'bairro' => $data['bairro'] ?? null,
                'localidade' => $data['localidade'] ?? null,
                'uf' => $data['uf'] ?? null,
                'estado' => $data['estado'] ?? null,
                'ibge' => $data['ibge'] ?? null,
                'ddd' => $data['ddd'] ?? null,
            ]);
        }

        \Log::debug(json_encode(Order::with('address')->find($order->id)));

        // session()->forget('cart');
        // Limpa o carrinho da sessão após o pedido
        session()->forget('cart');

        Mail::to('cpdrenato@gmail.com')->send(new OrderCreated($order));

        return redirect()->back()->with('success', 'Pedido realizado!');
    }

    private function calculateFreight(float $subtotal): float
    {
        if ($subtotal > 200) {
            return 0.0; // Frete grátis
        }

        if ($subtotal >= 52 && $subtotal <= 166.59) {
            return 15.0; // Frete médio
        }

        return 20.0; // Frete padrão
    }

    public function checkCep(Request $request)
    {
        $cep = preg_replace('/[^0-9]/', '', $request->cep);

        if (strlen($cep) !== 8) {
            return response()->json(['error' => 'CEP inválido'], 400);
        }

        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed()) {
            return response()->json(['error' => 'Erro ao consultar CEP'], 500);
        }

        return $response->json();
    }

}
