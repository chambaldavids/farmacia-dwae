@extends('layouts.app')

@section('titulo', 'Painel')

@section('conteudo')
<h1 class="h3 mb-4">Painel de controlo</h1>

<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="text-muted small">Medicamentos registados</div>
            <div class="fs-3 fw-bold">{{ $totalMedicamentos }}</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="text-muted small">Vendas hoje</div>
            <div class="fs-3 fw-bold">{{ $totalVendasHoje }}</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="text-muted small">Faturamento hoje</div>
            <div class="fs-3 fw-bold">{{ number_format($faturamentoHoje, 2, ',', '.') }} MT</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="text-muted small">Medicamentos com stock baixo</div>
            <div class="fs-3 fw-bold text-danger">{{ $medicamentosStockBaixo->count() }}</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-6">
        <div class="card p-3 h-100">
            <h2 class="h6 mb-3">⚠️ Stock baixo</h2>
            @if ($medicamentosStockBaixo->isEmpty())
                <p class="text-muted mb-0">Nenhum medicamento com stock abaixo do mínimo.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead><tr><th>Medicamento</th><th>Stock</th><th>Mínimo</th></tr></thead>
                        <tbody>
                        @foreach ($medicamentosStockBaixo as $m)
                            <tr>
                                <td><a href="{{ route('medicamentos.show', $m) }}">{{ $m->nome }}</a></td>
                                <td><span class="badge badge-stock-baixo">{{ $m->quantidade_stock }}</span></td>
                                <td>{{ $m->quantidade_minima }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card p-3 h-100">
            <h2 class="h6 mb-3">⏳ Validade próxima (60 dias)</h2>
            @if ($medicamentosAValidar->isEmpty())
                <p class="text-muted mb-0">Nenhum medicamento a expirar em breve.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead><tr><th>Medicamento</th><th>Validade</th></tr></thead>
                        <tbody>
                        @foreach ($medicamentosAValidar as $m)
                            <tr>
                                <td><a href="{{ route('medicamentos.show', $m) }}">{{ $m->nome }}</a></td>
                                <td><span class="badge badge-validade">{{ $m->data_validade->format('d/m/Y') }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="col-12">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h6 mb-0">🧾 Últimas vendas</h2>
                <a href="{{ route('vendas.create') }}" class="btn btn-primary btn-sm">+ Nova venda</a>
            </div>
            @if ($ultimasVendas->isEmpty())
                <p class="text-muted mb-0">Ainda não existem vendas registadas.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead><tr><th>Nº</th><th>Data</th><th>Cliente</th><th>Vendedor</th><th>Total</th><th>Estado</th></tr></thead>
                        <tbody>
                        @foreach ($ultimasVendas as $venda)
                            <tr>
                                <td><a href="{{ route('vendas.show', $venda) }}">{{ $venda->numero_venda }}</a></td>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
