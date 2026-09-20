@extends('layouts.app')

@section('titulo', $medicamento->nome)

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $medicamento->nome }}</h1>
    <div>
        <a href="{{ route('medicamentos.edit', $medicamento) }}" class="btn btn-outline-secondary">Editar</a>
        <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-primary">Voltar</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-8">
        <div class="card p-3">
            <dl class="row mb-0">
                <dt class="col-sm-4">Descrição</dt>
                <dd class="col-sm-8">{{ $medicamento->descricao ?: '—' }}</dd>

                <dt class="col-sm-4">Categoria</dt>
                <dd class="col-sm-8">{{ $medicamento->categoria->nome }}</dd>

                <dt class="col-sm-4">Fornecedor</dt>
                <dd class="col-sm-8">{{ $medicamento->fornecedor->nome }}</dd>

                <dt class="col-sm-4">Lote</dt>
                <dd class="col-sm-8">{{ $medicamento->lote ?: '—' }}</dd>

                <dt class="col-sm-4">Preço</dt>
                <dd class="col-sm-8">{{ number_format($medicamento->preco, 2, ',', '.') }} MT</dd>

                <dt class="col-sm-4">Data de validade</dt>
                <dd class="col-sm-8">
                    {{ $medicamento->data_validade?->format('d/m/Y') ?? '—' }}
                    @if ($medicamento->expirado)
                        <span class="badge bg-dark ms-1">Expirado</span>
                    @endif
                </dd>
            </dl>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card p-3 text-center">
            <div class="text-muted small">Stock atual</div>
            <div class="display-6 fw-bold {{ $medicamento->stock_baixo ? 'text-danger' : 'text-success' }}">
                {{ $medicamento->quantidade_stock }}
            </div>
            <div class="text-muted small">Mínimo definido: {{ $medicamento->quantidade_minima }}</div>
            @if ($medicamento->stock_baixo)
                <div class="alert alert-danger mt-3 mb-0 py-2">⚠️ Stock abaixo do mínimo.</div>
            @endif
        </div>
    </div>
</div>
@endsection
