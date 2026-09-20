<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// --- Rotas de autenticação (visitantes) ---
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('registar', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('registar', [RegisteredUserController::class, 'store']);
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// --- Rotas protegidas (utilizador autenticado) ---
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categorias', CategoriaController::class)->except('show');
    Route::resource('fornecedores', FornecedorController::class)->except('show');
    Route::resource('clientes', ClienteController::class)->except('show');
    Route::resource('medicamentos', MedicamentoController::class);

    Route::resource('vendas', VendaController::class)->only(['index', 'create', 'store', 'show']);
    Route::patch('vendas/{venda}/cancelar', [VendaController::class, 'cancelar'])->name('vendas.cancelar');
});
