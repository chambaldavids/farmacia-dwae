<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => [
                'required', 'string', 'max:100',
                Rule::unique('categorias', 'nome')->ignore($this->route('categoria')),
            ],
            'descricao' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
