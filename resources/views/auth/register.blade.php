@extends('layouts.app')

@section('titulo', 'Criar conta')

@section('conteudo')
<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="card mt-5">
            <div class="card-body p-4">
                <h1 class="h4 mb-4 text-center">💊 Farmácia DWAE</h1>
                <h2 class="h6 text-muted mb-4 text-center">Criar conta</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror" required autofocus>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Palavra-passe</label>
                        <input id="password" type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar palavra-passe</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Criar conta</button>
                </form>

                <p class="text-center text-muted mt-4 mb-0">
                    Já tem conta? <a href="{{ route('login') }}">Iniciar sessão</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
