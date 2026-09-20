<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_venda',
        'cliente_id',
        'user_id',
        'data_venda',
        'subtotal',
        'desconto',
        'total',
        'estado',
    ];

    protected $casts = [
        'data_venda' => 'datetime',
        'subtotal' => 'decimal:2',
        'desconto' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Utilizador (vendedor) que registou a venda.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ItemVenda::class);
    }
}
