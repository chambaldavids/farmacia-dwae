@extends('layouts.app')

@section('titulo', 'Novo medicamento')

@section('conteudo')
<h1 class="h3 mb-4">Novo medicamento</h1>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('medicamentos.store') }}">
            @csrf
            @include('medicamentos._form')
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
