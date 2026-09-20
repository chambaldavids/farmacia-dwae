@extends('layouts.app')

@section('titulo', 'Categorias')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Categorias</h1>
    <a href="{{ route('categorias.create') }}" class="btn btn-primary">+ Nova categoria</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th>Nome</th><th>Descrição</th><th>Medicamentos</th><th class="text-end">Ações</th></tr>
            </thead>
            <tbody>
            @forelse ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nome }}</td>
                    <td>{{ Str::limit($categoria->descricao, 60) ?: '—' }}</td>
                    <td><span class="badge bg-secondary">{{ $categoria->medicamentos_count }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Tem a certeza que deseja eliminar esta categoria?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">Nenhuma categoria registada.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $categorias->links() }}</div>
@endsection
