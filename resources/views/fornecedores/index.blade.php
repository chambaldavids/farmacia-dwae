@extends('layouts.app')

@section('titulo', 'Fornecedores')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Fornecedores</h1>
    <a href="{{ route('fornecedores.create') }}" class="btn btn-primary">+ Novo fornecedor</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th>Nome</th><th>NUIT</th><th>Telefone</th><th>Email</th><th>Medicamentos</th><th class="text-end">Ações</th></tr>
            </thead>
            <tbody>
            @forelse ($fornecedores as $fornecedor)
                <tr>
                    <td>{{ $fornecedor->nome }}</td>
                    <td>{{ $fornecedor->nuit ?: '—' }}</td>
                    <td>{{ $fornecedor->telefone ?: '—' }}</td>
                    <td>{{ $fornecedor->email ?: '—' }}</td>
                    <td><span class="badge bg-secondary">{{ $fornecedor->medicamentos_count }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('fornecedores.edit', $fornecedor) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="{{ route('fornecedores.destroy', $fornecedor) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Tem a certeza que deseja eliminar este fornecedor?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Nenhum fornecedor registado.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $fornecedores->links() }}</div>
@endsection
