@extends('layouts.app')

@section('titulo', 'Nova categoria')

@section('conteudo')
<h1 class="h3 mb-4">Nova categoria</h1>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('categorias.store') }}">
            @csrf
            @include('categorias._form')
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
