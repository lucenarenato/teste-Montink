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
        $product = Product::create($request->only('name', 'price'));

        foreach ($request->variations as $index => $variation) {
            Stock::create([
                'product_id' => $product->id,
                'variation' => $variation,
                'quantity' => $request->quantities[$index],
            ]);
        }

        return redirect()->back()->with('success', 'Produto criado com sucesso!');
    }

}
