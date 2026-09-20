@extends('layouts.app')

@section('titulo', 'Novo cliente')

@section('conteudo')
<h1 class="h3 mb-4">Novo cliente</h1>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('clientes.store') }}">
            @csrf
            @include('clientes._form')
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
