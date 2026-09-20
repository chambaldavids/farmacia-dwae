<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->text('descricao')->nullable();
            $table->foreignId('categoria_id')->constrained('categorias')->restrictOnDelete();
            $table->foreignId('fornecedor_id')->constrained('fornecedores')->restrictOnDelete();
            $table->decimal('preco', 10, 2);
            $table->unsignedInteger('quantidade_stock')->default(0);
            $table->unsignedInteger('quantidade_minima')->default(10);
            $table->string('lote', 50)->nullable();
            $table->date('data_validade')->nullable();
            $table->timestamps();

            $table->index('nome');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};
