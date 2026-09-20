<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicamentoRequest;
use App\Http\Requests\UpdateMedicamentoRequest;
use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Models\Medicamento;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MedicamentoController extends Controller
{
    public function index(Request $request): View
    {
        $medicamentos = Medicamento::with(['categoria', 'fornecedor'])
            ->when($request->filled('procurar'), function ($query) use ($request) {
                $query->where('nome', 'like', '%'.$request->string('procurar').'%');
            })
            ->when($request->filled('categoria_id'), function ($query) use ($request) {
                $query->where('categoria_id', $request->integer('categoria_id'));
            })
            ->orderBy('nome')
            ->paginate(10)
            ->withQueryString();

        $categorias = Categoria::orderBy('nome')->get();

        return view('medicamentos.index', compact('medicamentos', 'categorias'));
    }

    public function create(): View
    {
        $categorias = Categoria::orderBy('nome')->get();
        $fornecedores = Fornecedor::orderBy('nome')->get();

        return view('medicamentos.create', compact('categorias', 'fornecedores'));
    }

    public function store(StoreMedicamentoRequest $request): RedirectResponse
    {
        Medicamento::create($request->validated());

        return redirect()->route('medicamentos.index')->with('sucesso', 'Medicamento registado com sucesso.');
    }

    public function show(Medicamento $medicamento): View
    {
        $medicamento->load(['categoria', 'fornecedor']);

        return view('medicamentos.show', compact('medicamento'));
    }

    public function edit(Medicamento $medicamento): View
    {
        $categorias = Categoria::orderBy('nome')->get();
        $fornecedores = Fornecedor::orderBy('nome')->get();

        return view('medicamentos.edit', compact('medicamento', 'categorias', 'fornecedores'));
    }

    public function update(UpdateMedicamentoRequest $request, Medicamento $medicamento): RedirectResponse
    {
        $medicamento->update($request->validated());

        return redirect()->route('medicamentos.index')->with('sucesso', 'Medicamento atualizado com sucesso.');
    }

    public function destroy(Medicamento $medicamento): RedirectResponse
    {
        try {
            $medicamento->delete();
        } catch (QueryException $e) {
            return redirect()->route('medicamentos.index')
                ->with('erro', 'Não é possível eliminar: este medicamento já está associado a vendas registadas.');
        }

        return redirect()->route('medicamentos.index')->with('sucesso', 'Medicamento eliminado com sucesso.');
    }
}
