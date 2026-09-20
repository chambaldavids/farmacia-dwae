<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFornecedorRequest;
use App\Http\Requests\UpdateFornecedorRequest;
use App\Models\Fornecedor;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FornecedorController extends Controller
{
    public function index(): View
    {
        $fornecedores = Fornecedor::withCount('medicamentos')
            ->orderBy('nome')
            ->paginate(10);

        return view('fornecedores.index', compact('fornecedores'));
    }

    public function create(): View
    {
        return view('fornecedores.create');
    }

    public function store(StoreFornecedorRequest $request): RedirectResponse
    {
        Fornecedor::create($request->validated());

        return redirect()->route('fornecedores.index')->with('sucesso', 'Fornecedor criado com sucesso.');
    }

    public function edit(Fornecedor $fornecedor): View
    {
        return view('fornecedores.edit', compact('fornecedor'));
    }

    public function update(UpdateFornecedorRequest $request, Fornecedor $fornecedor): RedirectResponse
    {
        $fornecedor->update($request->validated());

        return redirect()->route('fornecedores.index')->with('sucesso', 'Fornecedor atualizado com sucesso.');
    }

    public function destroy(Fornecedor $fornecedor): RedirectResponse
    {
        try {
            $fornecedor->delete();
        } catch (QueryException $e) {
            return redirect()->route('fornecedores.index')
                ->with('erro', 'Não é possível eliminar: existem medicamentos associados a este fornecedor.');
        }

        return redirect()->route('fornecedores.index')->with('sucesso', 'Fornecedor eliminado com sucesso.');
    }
}
