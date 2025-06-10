@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <a class="btn btn-labeled btn-success" href="products/add" title="Create">Create</a> --}}
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
                        <button type="submit" class="btn btn-sm btn-success">Comprar</button>
                        <small>({{ $stock->variation }}: {{ $stock->quantity }} un)</small>
                    </form>
                </div>
            @endforeach
        </div>
    @endforeach

    <hr>
    @if(!is_null($products))
        <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <input type="text" name="cep" id="cep" placeholder="Digite o CEP" class="form-control mb-2">
            <button type="submit" class="btn btn-warning">Finalizar Pedido</button>
        </form>
    @else

    @endif

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
