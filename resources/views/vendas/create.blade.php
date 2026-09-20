@extends('layouts.app')

@section('titulo', 'Nova venda')

@section('conteudo')
<h1 class="h3 mb-4">Nova venda</h1>

<form method="POST" action="{{ route('vendas.store') }}" id="form-venda">
    @csrf

    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="cliente_id" class="form-label">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror">
                        <option value="">Consumidor final (sem registo)</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" @selected(old('cliente_id') == $cliente->id)>{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                    @error('cliente_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="desconto" class="form-label">Desconto (MT)</label>
                    <input type="number" step="0.01" min="0" name="desconto" id="desconto" class="form-control @error('desconto') is-invalid @enderror"
                           value="{{ old('desconto', 0) }}">
                    @error('desconto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h6 mb-0">Itens da venda</h2>
                <button type="button" class="btn btn-sm btn-outline-primary" id="btn-adicionar-item">+ Adicionar medicamento</button>
            </div>

            @error('itens')<div class="alert alert-danger py-2">{{ $message }}</div>@enderror

            <div class="table-responsive">
                <table class="table align-middle" id="tabela-itens">
                    <thead>
                        <tr>
                            <th style="min-width: 260px;">Medicamento</th>
                            <th style="width: 120px;">Quantidade</th>
                            <th style="width: 140px;">Preço unit.</th>
                            <th style="width: 140px;">Subtotal</th>
                            <th style="width: 60px;"></th>
                        </tr>
                    </thead>
                    <tbody id="corpo-itens">
                        <!-- linhas adicionadas via JavaScript -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total:</td>
                            <td class="fw-bold" id="total-venda">0,00 MT</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <p class="text-muted small mb-0">Nenhum medicamento sem stock disponível é apresentado na lista.</p>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Registar venda</button>
    <a href="{{ route('vendas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
</form>

<!-- Template de linha (usado pelo JavaScript, nunca enviado ao servidor) -->
<template id="template-linha-item">
    <tr class="linha-item">
        <td>
            <select name="itens[__INDEX__][medicamento_id]" class="form-select select-medicamento" required>
                <option value="">Selecione...</option>
                @foreach ($medicamentos as $medicamento)
                    <option value="{{ $medicamento->id }}"
                            data-preco="{{ $medicamento->preco }}"
                            data-stock="{{ $medicamento->quantidade_stock }}">
                        {{ $medicamento->nome }} (stock: {{ $medicamento->quantidade_stock }})
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" min="1" name="itens[__INDEX__][quantidade]" class="form-control input-quantidade" value="1" required>
        </td>
        <td class="preco-unitario">0,00 MT</td>
        <td class="subtotal-linha">0,00 MT</td>
        <td class="text-end">
            <button type="button" class="btn btn-sm btn-outline-danger btn-remover-linha">×</button>
        </td>
    </tr>
</template>
@endsection

@section('scripts')
<script>
(function () {
    const corpoItens = document.getElementById('corpo-itens');
    const template = document.getElementById('template-linha-item');
    const totalVendaEl = document.getElementById('total-venda');
    const descontoInput = document.getElementById('desconto');
    let indiceLinha = 0;

    function formatarMoeda(valor) {
        return valor.toLocaleString('pt-PT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' MT';
    }

    function recalcularLinha(linha) {
        const select = linha.querySelector('.select-medicamento');
        const quantidadeInput = linha.querySelector('.input-quantidade');
        const opcaoSelecionada = select.options[select.selectedIndex];
        const preco = opcaoSelecionada && opcaoSelecionada.value ? parseFloat(opcaoSelecionada.dataset.preco) : 0;
        const stockDisponivel = opcaoSelecionada && opcaoSelecionada.value ? parseInt(opcaoSelecionada.dataset.stock, 10) : null;

        if (stockDisponivel !== null && parseInt(quantidadeInput.value || '0', 10) > stockDisponivel) {
            quantidadeInput.value = stockDisponivel;
        }

        const quantidade = parseInt(quantidadeInput.value || '0', 10);
        const subtotal = preco * quantidade;

        linha.querySelector('.preco-unitario').textContent = formatarMoeda(preco);
        linha.querySelector('.subtotal-linha').textContent = formatarMoeda(subtotal);
        linha.dataset.subtotal = subtotal;

        recalcularTotal();
    }

    function recalcularTotal() {
        let total = 0;
        corpoItens.querySelectorAll('.linha-item').forEach(function (linha) {
            total += parseFloat(linha.dataset.subtotal || '0');
        });
        const desconto = parseFloat(descontoInput.value || '0');
        totalVendaEl.textContent = formatarMoeda(Math.max(total - desconto, 0));
    }

    function adicionarLinha() {
        const html = template.innerHTML.replaceAll('__INDEX__', indiceLinha);
        indiceLinha++;

        const div = document.createElement('tbody');
        div.innerHTML = html;
        const linha = div.querySelector('.linha-item');
        corpoItens.appendChild(linha);

        linha.querySelector('.select-medicamento').addEventListener('change', function () {
            recalcularLinha(linha);
        });
        linha.querySelector('.input-quantidade').addEventListener('input', function () {
            recalcularLinha(linha);
        });
        linha.querySelector('.btn-remover-linha').addEventListener('click', function () {
            linha.remove();
            recalcularTotal();
        });
    }

    document.getElementById('btn-adicionar-item').addEventListener('click', adicionarLinha);
    descontoInput.addEventListener('input', recalcularTotal);

    // Começa sempre com uma linha pronta a preencher.
    adicionarLinha();

    document.getElementById('form-venda').addEventListener('submit', function (e) {
        if (corpoItens.querySelectorAll('.linha-item').length === 0) {
            e.preventDefault();
            alert('Adicione pelo menos um medicamento à venda.');
        }
    });
})();
</script>
@endsection
