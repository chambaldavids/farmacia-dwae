@extends('layouts.app')

@section('titulo', 'Editar categoria')

@section('conteudo')
<h1 class="h3 mb-4">Editar categoria</h1>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('categorias.update', $categoria) }}">
            @csrf
            @method('PUT')
            @include('categorias._form')
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
