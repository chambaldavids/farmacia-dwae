@extends('layouts.app')

@section('titulo', 'Vendas')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Vendas</h1>
    <a href="{{ route('vendas.create') }}" class="btn btn-primary">+ Nova venda</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th>Nº Venda</th><th>Data</th><th>Cliente</th><th>Vendedor</th><th>Total</th><th>Estado</th><th class="text-end">Ações</th></tr>
            </thead>
            <tbody>
            @forelse ($vendas as $venda)
                <tr>
                    <td>{{ $venda->numero_venda }}</td>
                    <td>{{ $venda->data_venda->format('d/m/Y H:i') }}</td>
                    <td>{{ $venda->cliente->nome ?? 'Consumidor final' }}</td>
                    <td>{{ $venda->user->name }}</td>
                    <td>{{ number_format($venda->total, 2, ',', '.') }} MT</td>
                    <td>
                        @if($venda->estado === 'concluida')
                            <span class="badge bg-success">Concluída</span>
                        @else
                            <span class="badge bg-secondary">Cancelada</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('vendas.show', $venda) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Nenhuma venda registada.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $vendas->links() }}</div>
@endsection
