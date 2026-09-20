<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\Venda;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Painel inicial: indicadores gerais e alertas de stock baixo / validade próxima.
     */
    public function index(): View
    {
        $totalMedicamentos = Medicamento::count();
        $totalVendasHoje = Venda::whereDate('data_venda', today())
            ->where('estado', 'concluida')
            ->count();
        $faturamentoHoje = Venda::whereDate('data_venda', today())
            ->where('estado', 'concluida')
            ->sum('total');

        $medicamentosStockBaixo = Medicamento::whereColumn('quantidade_stock', '<=', 'quantidade_minima')
            ->orderBy('quantidade_stock')
            ->limit(10)
            ->get();

        $medicamentosAValidar = Medicamento::whereNotNull('data_validade')
            ->whereDate('data_validade', '<=', now()->addDays(60))
            ->orderBy('data_validade')
            ->limit(10)
            ->get();

        $ultimasVendas = Venda::with(['cliente', 'user'])
            ->latest('data_venda')
            ->limit(8)
            ->get();

        return view('dashboard', compact(
            'totalMedicamentos',
            'totalVendasHoje',
            'faturamentoHoje',
            'medicamentosStockBaixo',
            'medicamentosAValidar',
            'ultimasVendas',
        ));
    }
}
