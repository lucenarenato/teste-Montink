@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-labeled btn-success" href="products/add" title="Create">Cadastro de produtos</a>
                    <a class="btn btn-labeled btn-warning" href="coupons" title="Create">Listar coupons</a>
                    <hr>
                    <h3>Lista de Produtos</h3>
                    @foreach (\App\Models\Product::all() as $product)
                        <div class="card p-3 my-2">
                            <strong>{{ $product->name }}</strong> - R${{ $product->price }}
                            @foreach ($product->stocks as $stock)
                                <strong>({{ $stock->variation }}: {{ $stock->quantity }} un)</strong>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
