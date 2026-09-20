@extends('layouts.app')

@section('titulo', 'Editar cliente')

@section('conteudo')
<h1 class="h3 mb-4">Editar cliente</h1>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('clientes.update', $cliente) }}">
            @csrf
            @method('PUT')
            @include('clientes._form')
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
