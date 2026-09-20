<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    public function index(): View
    {
        $categorias = Categoria::withCount('medicamentos')
            ->orderBy('nome')
            ->paginate(10);

        return view('categorias.index', compact('categorias'));
    }

    public function create(): View
    {
        return view('categorias.create');
    }

    public function store(StoreCategoriaRequest $request): RedirectResponse
    {
        Categoria::create($request->validated());

        return redirect()->route('categorias.index')->with('sucesso', 'Categoria criada com sucesso.');
    }

    public function edit(Categoria $categoria): View
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria): RedirectResponse
    {
        $categoria->update($request->validated());

        return redirect()->route('categorias.index')->with('sucesso', 'Categoria atualizada com sucesso.');
    }

    /**
     * Remove a categoria, impedindo a eliminação caso existam medicamentos
     * associados (integridade referencial — parte do controlo de erros).
     */
    public function destroy(Categoria $categoria): RedirectResponse
    {
        try {
            $categoria->delete();
        } catch (QueryException $e) {
            return redirect()->route('categorias.index')
                ->with('erro', 'Não é possível eliminar: existem medicamentos associados a esta categoria.');
        }

        return redirect()->route('categorias.index')->with('sucesso', 'Categoria eliminada com sucesso.');
    }
}
