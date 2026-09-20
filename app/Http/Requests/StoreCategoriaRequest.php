<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:100', 'unique:categorias,nome'],
            'descricao' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.unique' => 'Já existe uma categoria com este nome.',
        ];
    }
}
