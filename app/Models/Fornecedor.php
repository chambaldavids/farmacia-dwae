<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fornecedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'nuit',
        'telefone',
        'email',
        'endereco',
    ];

    /**
     * Um fornecedor fornece muitos medicamentos.
     */
    public function medicamentos(): HasMany
    {
        return $this->hasMany(Medicamento::class);
    }
}
