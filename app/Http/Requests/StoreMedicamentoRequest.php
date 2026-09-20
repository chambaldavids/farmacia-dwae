<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:150'],
            'descricao' => ['nullable', 'string', 'max:1000'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'fornecedor_id' => ['required', 'exists:fornecedores,id'],
            'preco' => ['required', 'numeric', 'min:0'],
            'quantidade_stock' => ['required', 'integer', 'min:0'],
            'quantidade_minima' => ['required', 'integer', 'min:0'],
            'lote' => ['nullable', 'string', 'max:50'],
            'data_validade' => ['nullable', 'date', 'after:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'categoria_id.required' => 'Selecione uma categoria.',
            'fornecedor_id.required' => 'Selecione um fornecedor.',
            'preco.min' => 'O preço não pode ser negativo.',
            'data_validade.after' => 'A data de validade deve ser uma data futura.',
        ];
    }
}
