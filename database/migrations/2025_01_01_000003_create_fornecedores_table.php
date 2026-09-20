<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('nuit', 20)->nullable();
            $table->string('telefone', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('endereco', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};
