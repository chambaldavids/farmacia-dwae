<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendaRequest;
use App\Models\Cliente;
use App\Models\Medicamento;
use App\Models\Venda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class VendaController extends Controller
{
    public function index(): View
    {
        $vendas = Venda::with(['cliente', 'user'])
            ->latest('data_venda')
            ->paginate(10);

        return view('vendas.index', compact('vendas'));
    }

    public function create(): View
    {
        $clientes = Cliente::orderBy('nome')->get();
        $medicamentos = Medicamento::where('quantidade_stock', '>', 0)->orderBy('nome')->get();

        return view('vendas.create', compact('clientes', 'medicamentos'));
    }

    /**
     * Regista uma nova venda com vários itens numa única transação:
     * calcula subtotais/total, valida o stock disponível e deduz as
     * quantidades vendidas do stock de cada medicamento. Se algo falhar
     * a meio (ex.: stock insuficiente), a transação é revertida (rollback)
     * e nenhuma alteração fica gravada — controlo de erros e integridade
     * dos dados.
     */
    public function store(StoreVendaRequest $request): RedirectResponse
    {
        $dados = $request->validated();

        try {
            $venda = DB::transaction(function () use ($dados) {
                $subtotalGeral = 0;
                $itensParaGravar = [];

                foreach ($dados['itens'] as $item) {
                    // lockForUpdate evita condições de corrida (duas vendas em
                    // simultâneo a vender o último item do mesmo medicamento).
                    $medicamento = Medicamento::lockForUpdate()->findOrFail($item['medicamento_id']);

                    if ($medicamento->quantidade_stock < $item['quantidade']) {
                        throw ValidationException::withMessages([
                            'itens' => "Stock insuficiente para \"{$medicamento->nome}\" (disponível: {$medicamento->quantidade_stock}).",
                        ]);
                    }

                    $subtotalItem = $medicamento->preco * $item['quantidade'];
                    $subtotalGeral += $subtotalItem;

                    $itensParaGravar[] = [
                        'medicamento' => $medicamento,
                        'quantidade' => $item['quantidade'],
                        'preco_unitario' => $medicamento->preco,
                        'subtotal' => $subtotalItem,
                    ];
                }

                $desconto = $dados['desconto'] ?? 0;
                $total = max($subtotalGeral - $desconto, 0);

                $venda = Venda::create([
                    'numero_venda' => $this->gerarNumeroVenda(),
                    'cliente_id' => $dados['cliente_id'] ?? null,
                    'user_id' => Auth::id(),
                    'data_venda' => now(),
                    'subtotal' => $subtotalGeral,
                    'desconto' => $desconto,
                    'total' => $total,
                    'estado' => 'concluida',
                ]);

                foreach ($itensParaGravar as $item) {
                    $venda->itens()->create([
                        'medicamento_id' => $item['medicamento']->id,
                        'quantidade' => $item['quantidade'],
                        'preco_unitario' => $item['preco_unitario'],
                        'subtotal' => $item['subtotal'],
                    ]);

                    $item['medicamento']->decrement('quantidade_stock', $item['quantidade']);
                }

                return $venda;
            });
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            report($e);

            return redirect()->route('vendas.create')
                ->withInput()
                ->with('erro', 'Ocorreu um erro ao registar a venda. Nenhuma alteração foi gravada. Tente novamente.');
        }

        return redirect()->route('vendas.show', $venda)->with('sucesso', 'Venda registada com sucesso.');
    }

    public function show(Venda $venda): View
    {
        $venda->load(['cliente', 'user', 'itens.medicamento']);

        return view('vendas.show', compact('venda'));
    }

    /**
     * Cancela uma venda e repõe o stock dos medicamentos vendidos.
     */
    public function cancelar(Venda $venda): RedirectResponse
    {
        if ($venda->estado === 'cancelada') {
            return redirect()->route('vendas.show', $venda)->with('erro', 'Esta venda já se encontra cancelada.');
        }

        DB::transaction(function () use ($venda) {
            foreach ($venda->itens as $item) {
                $item->medicamento()->increment('quantidade_stock', $item->quantidade);
            }

            $venda->update(['estado' => 'cancelada']);
        });

        return redirect()->route('vendas.show', $venda)->with('sucesso', 'Venda cancelada e stock reposto.');
    }

    /**
     * Gera um número de venda sequencial único (ex.: VD-000001).
     */
    private function gerarNumeroVenda(): string
    {
        $ultimoId = (int) (Venda::max('id') ?? 0);

        return 'VD-'.str_pad((string) ($ultimoId + 1), 6, '0', STR_PAD_LEFT);
    }
}
