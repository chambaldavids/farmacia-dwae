<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Medicamento;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Utilizador administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@farmacia.co.mz',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Utilizador farmacêutico comum
        User::create([
            'name' => 'Farmacêutico Demo',
            'email' => 'farmaceutico@farmacia.co.mz',
            'password' => Hash::make('password'),
            'role' => 'farmaceutico',
        ]);

        // Categorias
        $categorias = [
            ['nome' => 'Analgésicos', 'descricao' => 'Medicamentos para alívio da dor.'],
            ['nome' => 'Antibióticos', 'descricao' => 'Medicamentos usados no combate a infeções bacterianas.'],
            ['nome' => 'Anti-inflamatórios', 'descricao' => 'Medicamentos usados para reduzir inflamações.'],
            ['nome' => 'Vitaminas e Suplementos', 'descricao' => 'Suplementos vitamínicos e minerais.'],
            ['nome' => 'Antialérgicos', 'descricao' => 'Medicamentos para tratamento de alergias.'],
        ];
        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }

        // Fornecedores
        $fornecedores = [
            ['nome' => 'Farmoz Moçambique, Lda', 'nuit' => '400123456', 'telefone' => '+258 84 111 2233', 'email' => 'geral@farmoz.co.mz', 'endereco' => 'Av. 25 de Setembro, Maputo'],
            ['nome' => 'MedSupply África', 'nuit' => '400987654', 'telefone' => '+258 82 555 6677', 'email' => 'vendas@medsupply.co.mz', 'endereco' => 'Av. Julius Nyerere, Maputo'],
            ['nome' => 'Globe Pharma Distribuidora', 'nuit' => '400654321', 'telefone' => '+258 86 333 4455', 'email' => 'contacto@globepharma.co.mz', 'endereco' => 'Matola, Cidade da Matola'],
        ];
        foreach ($fornecedores as $fornecedor) {
            Fornecedor::create($fornecedor);
        }

        // Clientes
        $clientes = [
            ['nome' => 'Consumidor Final', 'nuit' => null, 'telefone' => null, 'email' => null, 'endereco' => null],
            ['nome' => 'João Mahumana', 'nuit' => '110234567', 'telefone' => '+258 84 222 3344', 'email' => 'joao.mahumana@example.com', 'endereco' => 'Bairro Central, Maputo'],
            ['nome' => 'Clínica Esperança Lda', 'nuit' => '400345678', 'telefone' => '+258 21 456 789', 'email' => 'geral@esperanca.co.mz', 'endereco' => 'Av. Vladimir Lenine, Maputo'],
        ];
        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }

        // Medicamentos
        $medicamentos = [
            ['nome' => 'Paracetamol 500mg (cx 20 comp.)', 'categoria' => 'Analgésicos', 'fornecedor' => 'Farmoz Moçambique, Lda', 'preco' => 45.00, 'quantidade_stock' => 150, 'quantidade_minima' => 30, 'lote' => 'L2025-A1', 'data_validade' => now()->addMonths(18)],
            ['nome' => 'Ibuprofeno 400mg (cx 20 comp.)', 'categoria' => 'Anti-inflamatórios', 'fornecedor' => 'Farmoz Moçambique, Lda', 'preco' => 60.00, 'quantidade_stock' => 80, 'quantidade_minima' => 20, 'lote' => 'L2025-B2', 'data_validade' => now()->addMonths(14)],
            ['nome' => 'Amoxicilina 500mg (cx 12 cáps.)', 'categoria' => 'Antibióticos', 'fornecedor' => 'MedSupply África', 'preco' => 120.00, 'quantidade_stock' => 8, 'quantidade_minima' => 15, 'lote' => 'L2025-C3', 'data_validade' => now()->addMonths(3)],
            ['nome' => 'Vitamina C 1000mg (frasco 30 comp.)', 'categoria' => 'Vitaminas e Suplementos', 'fornecedor' => 'Globe Pharma Distribuidora', 'preco' => 90.00, 'quantidade_stock' => 60, 'quantidade_minima' => 10, 'lote' => 'L2025-D4', 'data_validade' => now()->addMonths(24)],
            ['nome' => 'Loratadina 10mg (cx 10 comp.)', 'categoria' => 'Antialérgicos', 'fornecedor' => 'MedSupply África', 'preco' => 55.00, 'quantidade_stock' => 5, 'quantidade_minima' => 10, 'lote' => 'L2025-E5', 'data_validade' => now()->addDays(45)],
            ['nome' => 'Azitromicina 500mg (cx 3 comp.)', 'categoria' => 'Antibióticos', 'fornecedor' => 'Globe Pharma Distribuidora', 'preco' => 150.00, 'quantidade_stock' => 40, 'quantidade_minima' => 10, 'lote' => 'L2025-F6', 'data_validade' => now()->addMonths(20)],
        ];

        foreach ($medicamentos as $medicamento) {
            Medicamento::create([
                'nome' => $medicamento['nome'],
                'descricao' => null,
                'categoria_id' => Categoria::where('nome', $medicamento['categoria'])->first()->id,
                'fornecedor_id' => Fornecedor::where('nome', $medicamento['fornecedor'])->first()->id,
                'preco' => $medicamento['preco'],
                'quantidade_stock' => $medicamento['quantidade_stock'],
                'quantidade_minima' => $medicamento['quantidade_minima'],
                'lote' => $medicamento['lote'],
                'data_validade' => $medicamento['data_validade'],
            ]);
        }
    }
}
