@php $medicamento = $medicamento ?? null; @endphp

<div class="row">
    <div class="col-12 col-md-8 mb-3">
        <label for="nome" class="form-label">Nome *</label>
        <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
               value="{{ old('nome', $medicamento->nome ?? '') }}" required maxlength="150">
        @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12 col-md-4 mb-3">
        <label for="lote" class="form-label">Lote</label>
        <input type="text" name="lote" id="lote" class="form-control @error('lote') is-invalid @enderror"
               value="{{ old('lote', $medicamento->lote ?? '') }}" maxlength="50">
        @error('lote')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12 mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" rows="2"
                  class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao', $medicamento->descricao ?? '') }}</textarea>
        @error('descricao')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12 col-md-6 mb-3">
        <label for="categoria_id" class="form-label">Categoria *</label>
        <select name="categoria_id" id="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror" required>
            <option value="">Selecione...</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected(old('categoria_id', $medicamento->categoria_id ?? '') == $categoria->id)>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
        @error('categoria_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label for="fornecedor_id" class="form-label">Fornecedor *</label>
        <select name="fornecedor_id" id="fornecedor_id" class="form-select @error('fornecedor_id') is-invalid @enderror" required>
            <option value="">Selecione...</option>
            @foreach ($fornecedores as $fornecedor)
                <option value="{{ $fornecedor->id }}" @selected(old('fornecedor_id', $medicamento->fornecedor_id ?? '') == $fornecedor->id)>
                    {{ $fornecedor->nome }}
                </option>
            @endforeach
        </select>
        @error('fornecedor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-6 col-md-3 mb-3">
        <label for="preco" class="form-label">Preço (MT) *</label>
        <input type="number" step="0.01" min="0" name="preco" id="preco"
               class="form-control @error('preco') is-invalid @enderror"
               value="{{ old('preco', $medicamento->preco ?? '') }}" required>
        @error('preco')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-6 col-md-3 mb-3">
        <label for="quantidade_stock" class="form-label">Stock atual *</label>
        <input type="number" min="0" name="quantidade_stock" id="quantidade_stock"
               class="form-control @error('quantidade_stock') is-invalid @enderror"
               value="{{ old('quantidade_stock', $medicamento->quantidade_stock ?? 0) }}" required>
        @error('quantidade_stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-6 col-md-3 mb-3">
        <label for="quantidade_minima" class="form-label">Stock mínimo *</label>
        <input type="number" min="0" name="quantidade_minima" id="quantidade_minima"
               class="form-control @error('quantidade_minima') is-invalid @enderror"
               value="{{ old('quantidade_minima', $medicamento->quantidade_minima ?? 10) }}" required>
        @error('quantidade_minima')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-6 col-md-3 mb-3">
        <label for="data_validade" class="form-label">Data de validade</label>
        <input type="date" name="data_validade" id="data_validade"
               class="form-control @error('data_validade') is-invalid @enderror"
               value="{{ old('data_validade', isset($medicamento->data_validade) ? $medicamento->data_validade->format('Y-m-d') : '') }}">
        @error('data_validade')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
