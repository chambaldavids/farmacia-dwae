<?php

namespace App\Http\Requests;

class UpdateMedicamentoRequest extends StoreMedicamentoRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        // Na edição, a data de validade pode já estar no passado (não bloqueia a edição de registos antigos).
        $rules['data_validade'] = ['nullable', 'date'];

        return $rules;
    }
}
