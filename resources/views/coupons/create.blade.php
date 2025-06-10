@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1>Novo Cupom</h1>

                    <form action="{{ route('coupons.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="code" class="form-label">Código</label>
                            <input type="text" name="code" id="code" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="discount" class="form-label">Desconto (R$)</label>
                            <input type="number" step="0.01" name="discount" id="discount" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="min_subtotal" class="form-label">Valor mínimo para uso (R$)</label>
                            <input type="number" step="0.01" name="min_subtotal" id="min_subtotal" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="valid_until" class="form-label">Válido até</label>
                            <input type="date" name="valid_until" id="valid_until" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success">Salvar</button>
                        <a href="{{ route('coupons.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
