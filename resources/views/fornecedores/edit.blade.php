@extends('layouts.app')

@section('titulo', 'Editar fornecedor')

@section('conteudo')
<h1 class="h3 mb-4">Editar fornecedor</h1>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('fornecedores.update', $fornecedor) }}">
            @csrf
            @method('PUT')
            @include('fornecedores._form')
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('fornecedores.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
