<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Executa a seed.
     */
    public function run(): void
    {
        $fornecedores = [
            [
                'nome' => 'Tech Store LTDA',
                'cnpj' => '12.345.678/0001-90',
                'email' => 'contato@techstore.com',
                'telefone' => '(18) 99999-1234',
                'endereco' => 'Av. Brasil, 1000 - Presidente Prudente/SP',
            ],
            [
                'nome' => 'Office Solutions ME',
                'cnpj' => '98.765.432/0001-12',
                'email' => 'vendas@officesolutions.com',
                'telefone' => '(18) 98888-4321',
                'endereco' => 'Rua das Palmeiras, 200 - Presidente Prudente/SP',
            ],
            [
                'nome' => 'Eletrônicos Silva EIRELI',
                'cnpj' => '11.222.333/0001-44',
                'email' => 'suporte@eletronicossilva.com',
                'telefone' => '(18) 97777-5678',
                'endereco' => 'Av. Manoel Goulart, 1500 - Presidente Prudente/SP',
            ],
        ];

        foreach ($fornecedores as $fornecedor) {
            Fornecedor::create($fornecedor);
        }
    }
}
