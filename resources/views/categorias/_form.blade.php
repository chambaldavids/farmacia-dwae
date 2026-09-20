@php $categoria = $categoria ?? null; @endphp

<div class="mb-3">
    <label for="nome" class="form-label">Nome *</label>
    <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
           value="{{ old('nome', $categoria->nome ?? '') }}" required maxlength="100">
    @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="descricao" class="form-label">Descrição</label>
    <textarea name="descricao" id="descricao" rows="3"
              class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao', $categoria->descricao ?? '') }}</textarea>
    @error('descricao')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
