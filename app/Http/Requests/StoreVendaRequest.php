<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id' => ['nullable', 'exists:clientes,id'],
            'desconto' => ['nullable', 'numeric', 'min:0'],
            'itens' => ['required', 'array', 'min:1'],
            'itens.*.medicamento_id' => ['required', 'exists:medicamentos,id'],
            'itens.*.quantidade' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'itens.required' => 'Adicione pelo menos um medicamento à venda.',
            'itens.min' => 'Adicione pelo menos um medicamento à venda.',
            'itens.*.medicamento_id.required' => 'Selecione o medicamento em todas as linhas.',
            'itens.*.quantidade.min' => 'A quantidade deve ser pelo menos 1.',
        ];
    }
}
