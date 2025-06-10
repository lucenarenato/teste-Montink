<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('stocks')->get();
        return view('products.index', compact('products'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'variation.*' => 'nullable|string',
            'quantity.*' => 'nullable|integer|min:0',
        ]);

        $product = Product::create($request->only('name', 'price'));

        foreach ($request->variations as $index => $variation) {
            if (!empty($variation)) {
                Stock::create([
                    'product_id' => $product->id,
                    'variation' => $variation,
                    'quantity' => $request->quantities[$index],
                ]);
            }

        }

        //return redirect()->back()->with('success', 'Produto criado com sucesso!');
        return redirect()->route('products.index')->with('success', 'Produto criado');
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->only('name', 'price'));
        foreach ($request->stock_id as $i => $stockId) {
            $stock = Stock::find($stockId);
            if ($stock) {
                $stock->update([
                    'variation' => $request->variation[$i],
                    'quantity' => $request->quantity[$i],
                ]);
            }
        }

        return back()->with('success', 'Produto atualizado');
    }

    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => ($cart[$product->id]['quantity'] ?? 0) + 1,
        ];
        session(['cart' => $cart]);
        return redirect()->route('products.index')->with('success', 'Adicionado ao carrinho!');
    }

}
