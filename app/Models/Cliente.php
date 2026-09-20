<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'nuit',
        'telefone',
        'email',
        'endereco',
    ];

    public function vendas(): HasMany
    {
        return $this->hasMany(Venda::class);
    }
}
