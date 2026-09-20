@extends('layouts.app')

@section('titulo', 'Venda '.$venda->numero_venda)

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Venda {{ $venda->numero_venda }}</h1>
    <div>
        @if ($venda->estado === 'concluida')
            <form action="{{ route('vendas.cancelar', $venda) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Cancelar esta venda e repor o stock dos medicamentos?');">
                @csrf @method('PATCH')
                <button type="submit" class="btn btn-outline-danger">Cancelar venda</button>
            </form>
        @endif
        <a href="{{ route('vendas.index') }}" class="btn btn-outline-primary">Voltar</a>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-12 col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Data</div>
            <div class="fw-bold">{{ $venda->data_venda->format('d/m/Y H:i') }}</div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Cliente</div>
            <div class="fw-bold">{{ $venda->cliente->nome ?? 'Consumidor final' }}</div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Vendedor</div>
            <div class="fw-bold">{{ $venda->user->name }}</div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Estado</div>
            <div>
                @if($venda->estado === 'concluida')
                    <span class="badge bg-success">Concluída</span>
                @else
                    <span class="badge bg-secondary">Cancelada</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr><th>Medicamento</th><th>Quantidade</th><th>Preço unitário</th><th>Subtotal</th></tr>
            </thead>
            <tbody>
            @foreach ($venda->itens as $item)
                <tr>
                    <td>{{ $item->medicamento->nome }}</td>
                    <td>{{ $item->quantidade }}</td>
                    <td>{{ number_format($item->preco_unitario, 2, ',', '.') }} MT</td>
                    <td>{{ number_format($item->subtotal, 2, ',', '.') }} MT</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr><td colspan="3" class="text-end">Subtotal</td><td>{{ number_format($venda->subtotal, 2, ',', '.') }} MT</td></tr>
                <tr><td colspan="3" class="text-end">Desconto</td><td>{{ number_format($venda->desconto, 2, ',', '.') }} MT</td></tr>
                <tr class="fw-bold"><td colspan="3" class="text-end">Total</td><td>{{ number_format($venda->total, 2, ',', '.') }} MT</td></tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
