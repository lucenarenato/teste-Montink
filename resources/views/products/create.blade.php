@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
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
                            <hr>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                        <hr>
                </div>

            </div>
        </div>
    </div>
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
