<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
    ];

    /**
     * Uma categoria tem muitos medicamentos.
     */
    public function medicamentos(): HasMany
    {
        return $this->hasMany(Medicamento::class);
    }
}
