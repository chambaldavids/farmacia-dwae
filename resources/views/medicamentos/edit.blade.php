@extends('layouts.app')

@section('titulo', 'Editar medicamento')

@section('conteudo')
<h1 class="h3 mb-4">Editar medicamento</h1>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('medicamentos.update', $medicamento) }}">
            @csrf
            @method('PUT')
            @include('medicamentos._form')
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
