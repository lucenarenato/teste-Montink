@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cadastro de Produtos</h2>
    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Nome" class="form-control" required>
        <input type="number" name="price" step="0.01" placeholder="Preço" class="form-control" required>

        <div id="variations">
            <div class="d-flex mb-2">
                <input type="text" name="variations[]" placeholder="Variação" class="form-control me-2">
                <input type="number" name="quantities[]" placeholder="Estoque" class="form-control">
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addVariation()">+ Variação</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

    <hr>

    <h3>Produtos</h3>
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
                        <button type="submit" class="btn btn-sm btn-success">Comprar</button>
                        <small>({{ $stock->variation }}: {{ $stock->quantity }} un)</small>
                    </form>
                </div>
            @endforeach
        </div>
    @endforeach

    <hr>
    <form method="POST" action="{{ route('checkout') }}">
        @csrf
        <input type="text" name="cep" id="cep" placeholder="Digite o CEP" class="form-control mb-2">
        <button type="submit" class="btn btn-warning">Finalizar Pedido</button>
    </form>
</div>

<script>
function addVariation() {
    const div = document.createElement('div');
    div.classList.add('d-flex', 'mb-2');
    div.innerHTML = `
        <input type="text" name="variations[]" placeholder="Variação" class="form-control me-2">
        <input type="number" name="quantities[]" placeholder="Estoque" class="form-control">
    `;
    document.getElementById('variations').appendChild(div);
}
</script>
@endsection
