@extends('layouts.app')

@section('titulo', 'Novo fornecedor')

@section('conteudo')
<h1 class="h3 mb-4">Novo fornecedor</h1>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('fornecedores.store') }}">
            @csrf
            @include('fornecedores._form')
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('fornecedores.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
