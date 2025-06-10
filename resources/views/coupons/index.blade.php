@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1>Cupons</h1>
                    <a href="{{ route('coupons.create') }}" class="btn btn-primary mb-3">Novo Cupom</a>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Desconto</th>
                                <th>Mínimo</th>
                                <th>Válido até</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->code }}</td>
                                <td>R$ {{ number_format($coupon->discount, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format($coupon->min_subtotal, 2, ',', '.') }}</td>
                                <td>{{ date('d/m/Y', strtotime($coupon->valid_until)) }}</td>
                                <td>
                                    <a href="{{ route('coupons.edit', $coupon) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('coupons.destroy', $coupon) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
