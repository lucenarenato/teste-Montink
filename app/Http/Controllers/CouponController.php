<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    // Lista todos os cupons
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupons.index', compact('coupons'));
    }

    // Formulário para cadastrar novo cupom
    public function create()
    {
        return view('coupons.create');
    }

    // Salva o novo cupom no banco
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:coupons',
            'discount' => 'required|numeric|min:0',
            'min_subtotal' => 'required|numeric|min:0',
            'valid_until' => 'required|date|after_or_equal:today',
        ]);

        Coupon::create($request->all());

        return redirect()->route('coupons.index')->with('success', 'Cupom cadastrado com sucesso!');
    }

    // Exibe detalhes de um cupom (opcional)
    public function show(Coupon $coupon)
    {
        return view('coupons.show', compact('coupon'));
    }

    // Formulário para editar cupom
    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    // Atualiza cupom no banco
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code,' . $coupon->id,
            'discount' => 'required|numeric|min:0',
            'min_subtotal' => 'required|numeric|min:0',
            'valid_until' => 'required|date|after_or_equal:today',
        ]);

        $coupon->update($request->all());

        return redirect()->route('coupons.index')->with('success', 'Cupom atualizado com sucesso!');
    }

    // Deleta cupom
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Cupom excluído com sucesso!');
    }
}
