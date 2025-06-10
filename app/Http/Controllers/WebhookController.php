<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function orderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'status' => 'required|string',
        ]);

        $order = Order::find($request->order_id);

        if (!$order) {
            return response()->json(['error' => 'Pedido não encontrado'], 404);
        }

        if (strtolower($request->status) === 'cancelado') {
            $order->delete();
            return response()->json(['message' => 'Pedido removido']);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Status atualizado']);
    }

}
