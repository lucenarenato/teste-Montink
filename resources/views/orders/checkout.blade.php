@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Checkout</h2>
    <form method="POST" action="{{ route('orders.checkout') }}">
        @csrf

        <div>
            <label>CEP</label>
            <input name="cep" id="cep" required>
            <button type="button" onclick="checkCep()">Verificar</button>
        </div>

        <ul>
            @foreach($cart as $item)
                <li>{{ $item['name'] }} x{{ $item['quantity'] }} - R$ {{ number_format($item['price'], 2, ',', '.') }}</li>
            @endforeach
        </ul>

        <button class="btn btn-primary">Finalizar Pedido</button>
    </form>
</div>

<script>
function checkCep() {
    const cep = document.getElementById('cep').value;
    fetch('/cep/check?cep=' + cep)
        .then(res => res.json())
        .then(data => alert(data.logradouro ?? 'CEP não encontrado'));
}
</script>
@endsection
