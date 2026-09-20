@php $cliente = $cliente ?? null; @endphp

<div class="row">
    <div class="col-12 col-md-6 mb-3">
        <label for="nome" class="form-label">Nome *</label>
        <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
               value="{{ old('nome', $cliente->nome ?? '') }}" required maxlength="150">
        @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label for="nuit" class="form-label">NUIT</label>
        <input type="text" name="nuit" id="nuit" class="form-control @error('nuit') is-invalid @enderror"
               value="{{ old('nuit', $cliente->nuit ?? '') }}" maxlength="20">
        @error('nuit')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" name="telefone" id="telefone" class="form-control @error('telefone') is-invalid @enderror"
               value="{{ old('telefone', $cliente->telefone ?? '') }}" maxlength="30">
        @error('telefone')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $cliente->email ?? '') }}" maxlength="150">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12 mb-3">
        <label for="endereco" class="form-label">Endereço</label>
        <input type="text" name="endereco" id="endereco" class="form-control @error('endereco') is-invalid @enderror"
               value="{{ old('endereco', $cliente->endereco ?? '') }}" maxlength="255">
        @error('endereco')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
