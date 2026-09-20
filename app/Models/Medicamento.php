<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medicamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'categoria_id',
        'fornecedor_id',
        'preco',
        'quantidade_stock',
        'quantidade_minima',
        'lote',
        'data_validade',
    ];

    protected $casts = [
        'preco' => 'decimal:2',
        'data_validade' => 'date',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function itensVenda(): HasMany
    {
        return $this->hasMany(ItemVenda::class);
    }

    /**
     * Indica se o stock atual está abaixo (ou igual) ao stock mínimo definido.
     */
    public function getStockBaixoAttribute(): bool
    {
        return $this->quantidade_stock <= $this->quantidade_minima;
    }

    /**
     * Indica se o medicamento já está fora do prazo de validade.
     */
    public function getExpiradoAttribute(): bool
    {
        return $this->data_validade !== null && $this->data_validade->isPast();
    }
}
