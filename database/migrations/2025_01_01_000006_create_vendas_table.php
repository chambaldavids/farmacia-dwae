<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_venda', 20)->unique();
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->dateTime('data_venda');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('desconto', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->enum('estado', ['concluida', 'cancelada'])->default('concluida');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
