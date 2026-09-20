@extends('layouts.app')

@section('titulo', 'Medicamentos')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Medicamentos</h1>
    <a href="{{ route('medicamentos.create') }}" class="btn btn-primary">+ Novo medicamento</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('medicamentos.index') }}" class="row g-2 align-items-end">
            <div class="col-12 col-md-6">
                <label class="form-label">Procurar por nome</label>
                <input type="text" name="procurar" value="{{ request('procurar') }}" class="form-control" placeholder="Ex.: paracetamol">
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label">Categoria</label>
                <select name="categoria_id" class="form-select">
                    <option value="">Todas</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected(request('categoria_id') == $categoria->id)>{{ $categoria->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-2 d-grid">
                <button type="submit" class="btn btn-outline-primary">Filtrar</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th>Nome</th><th>Categoria</th><th>Fornecedor</th><th>Preço</th><th>Stock</th><th>Validade</th><th class="text-end">Ações</th></tr>
            </thead>
            <tbody>
            @forelse ($medicamentos as $medicamento)
                <tr>
                    <td><a href="{{ route('medicamentos.show', $medicamento) }}">{{ $medicamento->nome }}</a></td>
                    <td>{{ $medicamento->categoria->nome }}</td>
                    <td>{{ $medicamento->fornecedor->nome }}</td>
                    <td>{{ number_format($medicamento->preco, 2, ',', '.') }} MT</td>
                    <td>
                        <span class="badge {{ $medicamento->stock_baixo ? 'badge-stock-baixo' : 'bg-success' }}">
                            {{ $medicamento->quantidade_stock }}
                        </span>
                    </td>
                    <td>
                        @if ($medicamento->data_validade)
                            <span class="badge {{ $medicamento->expirado ? 'bg-dark' : 'bg-light text-dark border' }}">
                                {{ $medicamento->data_validade->format('d/m/Y') }}
                            </span>
                        @else
                            —
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('medicamentos.edit', $medicamento) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="{{ route('medicamentos.destroy', $medicamento) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Tem a certeza que deseja eliminar este medicamento?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Nenhum medicamento encontrado.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $medicamentos->links() }}</div>
@endsection
