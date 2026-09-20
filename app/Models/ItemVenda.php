<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemVenda extends Model
{
    use HasFactory;

    protected $table = 'itens_venda';

    protected $fillable = [
        'venda_id',
        'medicamento_id',
        'quantidade',
        'preco_unitario',
        'subtotal',
    ];

    protected $casts = [
        'preco_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function venda(): BelongsTo
    {
        return $this->belongsTo(Venda::class);
    }

    public function medicamento(): BelongsTo
    {
        return $this->belongsTo(Medicamento::class);
    }
}
