@extends('layouts.app')

@section('titulo', 'Iniciar sessão')

@section('conteudo')
<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="card mt-5">
            <div class="card-body p-4">
                <h1 class="h4 mb-4 text-center">💊 Farmácia DWAE</h1>
                <h2 class="h6 text-muted mb-4 text-center">Iniciar sessão</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror" required autofocus>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Palavra-passe</label>
                        <input id="password" type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Lembrar-me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>

                <p class="text-center text-muted mt-4 mb-0">
                    Ainda não tem conta? <a href="{{ route('register') }}">Registar-se</a>
                </p>
                <p class="text-center text-muted small mt-2 mb-0">
                    Demo: admin@farmacia.co.mz / password
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
