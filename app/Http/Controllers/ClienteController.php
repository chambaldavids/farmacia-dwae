<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClienteController extends Controller
{
    public function index(): View
    {
        $clientes = Cliente::orderBy('nome')->paginate(10);

        return view('clientes.index', compact('clientes'));
    }

    public function create(): View
    {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest $request): RedirectResponse
    {
        Cliente::create($request->validated());

        return redirect()->route('clientes.index')->with('sucesso', 'Cliente criado com sucesso.');
    }

    public function edit(Cliente $cliente): View
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente): RedirectResponse
    {
        $cliente->update($request->validated());

        return redirect()->route('clientes.index')->with('sucesso', 'Cliente atualizado com sucesso.');
    }

    public function destroy(Cliente $cliente): RedirectResponse
    {
        try {
            $cliente->delete();
        } catch (QueryException $e) {
            return redirect()->route('clientes.index')
                ->with('erro', 'Não é possível eliminar: existem vendas associadas a este cliente.');
        }

        return redirect()->route('clientes.index')->with('sucesso', 'Cliente eliminado com sucesso.');
    }
}
