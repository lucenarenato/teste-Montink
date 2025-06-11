@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-labeled btn-success" href="products/add" title="Create">Cadastro de produtos</a>
    <a class="btn btn-labeled btn-warning" href="coupons" title="Create">Listar coupons</a>
    <h3>Lista de Produtos</h3>
    @foreach ($products as $product)
        <div class="card p-3 my-2">
            <strong>{{ $product->name }}</strong> - R${{ $product->price }}
            @foreach ($product->stocks as $stock)
                <div>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="variation" value="{{ $stock->variation }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="number" name="quantity" min="1" max="{{ $stock->quantity }}">
                        <button type="submit" class="btn btn-sm btn-success">Adicionar Carrinho</button>
                        <small>({{ $stock->variation }}: {{ $stock->quantity }} un)</small>
                    </form>
                </div>
            @endforeach
        </div>
    @endforeach

    <hr>

    @if(!is_null($products))
        <form id="checkoutForm" method="POST" action="{{ route('checkout') }}">
            @csrf
            @foreach ($cart as $key => $item)
                <input type="hidden" name="cart[{{ $key }}][product_id]" value="{{ $item['product_id'] }}">
                <input type="hidden" name="cart[{{ $key }}][variation]" value="{{ $item['variation'] }}">
                <input type="hidden" name="cart[{{ $key }}][price]" value="{{ $item['price'] }}">
                <input type="hidden" name="cart[{{ $key }}][quantity]" value="{{ $item['quantity'] }}">
            @endforeach
            <input type="text" name="cep" id="cep" placeholder="Digite o CEP" class="form-control mb-2" required>
            <div id="cepError" class="text-danger mt-2 d-none">CEP inválido ou não encontrado.</div>

            <!-- Campo de Cupom -->
            <input type="text" name="coupon_code" id="coupon_code" placeholder="Código do Cupom (opcional)" class="form-control mb-2">

            <button type="submit" class="btn btn-warning">Finalizar Pedido</button>
        </form>
    @endif
    <hr>
    @if ($orders->isNotEmpty())
        <h3>Lista de pedidos</h3>
        @foreach ($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Pedido #{{ $order->id }}</h5>

                    @if ($order->address)
                        <p><strong>Endereço:</strong></p>
                        <p>{{ $order->address->logradouro }}, {{ $order->address->bairro }}, {{ $order->address->localidade }} - {{ $order->address->uf }}</p>
                    @else
                        <p><em>Sem endereço cadastrado.</em></p>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p>Nenhum pedido encontrado.</p>
    @endif
</div>

<script>
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    const cepInput = document.getElementById('cep');
    const cepError = document.getElementById('cepError');
    const cep = cepInput.value.replace(/\D/g, '');

    if (cep.length !== 8) {
        e.preventDefault();
        cepError.textContent = 'CEP deve ter 8 dígitos.';
        cepError.classList.remove('d-none');
        return;
    }

    fetch(`/check-cep?cep=${cep}`)
        .then(response => response.json())
        .then(data => {
            if (data.error || !data.cep) {
                e.preventDefault();
                cepError.textContent = data.error || 'CEP inválido ou não encontrado.';
                cepError.classList.remove('d-none');
            } else {
                cepError.classList.add('d-none');
            }
        })
        .catch(err => {
            e.preventDefault();
            cepError.textContent = 'Erro ao consultar o CEP. Tente novamente.';
            cepError.classList.remove('d-none');
        });
});
</script>
@endsection
