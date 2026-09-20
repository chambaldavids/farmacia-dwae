<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Início') · Farmácia DWAE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="data:,">
    <style>
        body { background-color: #f4f6f8; }
        .navbar-brand { font-weight: 600; }
        .card { border: none; box-shadow: 0 1px 3px rgba(0,0,0,.08); }
        .table thead th { white-space: nowrap; }
        .badge-stock-baixo { background-color: #dc3545; }
        .badge-validade { background-color: #fd7e14; }
    </style>
</head>
<body>
@auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">💊 Farmácia DWAE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">Painel</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('medicamentos.*')) active @endif" href="{{ route('medicamentos.index') }}">Medicamentos</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('vendas.*')) active @endif" href="{{ route('vendas.index') }}">Vendas</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('clientes.*')) active @endif" href="{{ route('clientes.index') }}">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('fornecedores.*')) active @endif" href="{{ route('fornecedores.index') }}">Fornecedores</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('categorias.*')) active @endif" href="{{ route('categorias.index') }}">Categorias</a></li>
                </ul>
                <span class="navbar-text text-light me-3">Olá, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf
                    <button class="btn btn-outline-light btn-sm" type="submit">Terminar sessão</button>
                </form>
            </div>
        </div>
    </nav>
@endauth

<main class="container-fluid px-3 px-md-4 pb-5" style="max-width: 1280px;">
    @if (session('sucesso'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('sucesso') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('erro'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('erro') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Foram encontrados erros no formulário:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('conteudo')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
