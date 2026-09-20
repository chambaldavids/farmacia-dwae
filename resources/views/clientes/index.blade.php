@extends('layouts.app')

@section('titulo', 'Clientes')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">+ Novo cliente</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th>Nome</th><th>NUIT</th><th>Telefone</th><th>Email</th><th class="text-end">Ações</th></tr>
            </thead>
            <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->nuit ?: '—' }}</td>
                    <td>{{ $cliente->telefone ?: '—' }}</td>
                    <td>{{ $cliente->email ?: '—' }}</td>
                    <td class="text-end">
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Tem a certeza que deseja eliminar este cliente?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Nenhum cliente registado.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $clientes->links() }}</div>
@endsection
