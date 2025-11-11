<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    /**
     * Executa o seeder.
     */
    public function run(): void
    {
        $produtos = [
        [
            'nome' => 'Mouse Gamer RGB',
            'descricao' => 'Mouse ergonômico com iluminação RGB e 6 botões programáveis.',
            'preco' => 149.90,
            'quantidade' => 25,
            'fornecedor_id' => 1,
            'user_id' => 1, // 👈 adiciona quem cadastrou
        ],
        [
            'nome' => 'Teclado Mecânico',
            'descricao' => 'Teclado com switches azuis e retroiluminação ajustável.',
            'preco' => 299.00,
            'quantidade' => 15,
            'fornecedor_id' => 2,
            'user_id' => 1,
        ],
        [
            'nome' => 'Monitor 24" Full HD',
            'descricao' => 'Monitor LED de 24 polegadas com tecnologia IPS.',
            'preco' => 899.90,
            'quantidade' => 10,
            'fornecedor_id' => 1,
            'user_id' => 1,
        ],
        [
            'nome' => 'Headset com Microfone',
            'descricao' => 'Headset estéreo com som surround e cancelamento de ruído.',
            'preco' => 219.50,
            'quantidade' => 18,
            'fornecedor_id' => 3,
            'user_id' => 1,
        ],
        [
            'nome' => 'Cadeira Gamer Reclinável',
            'descricao' => 'Cadeira com ajuste de altura e apoio lombar.',
            'preco' => 1299.99,
            'quantidade' => 7,
            'fornecedor_id' => 2,
            'user_id' => 1,
        ],
        [
            'nome' => 'SSD NVMe 1TB',
            'descricao' => 'Unidade de armazenamento ultrarrápida NVMe Gen 4.',
            'preco' => 549.90,
            'quantidade' => 30,
            'fornecedor_id' => 1,
            'user_id' => 1,
        ],
        [
            'nome' => 'Webcam Full HD',
            'descricao' => 'Webcam 1080p com microfone embutido e foco automático.',
            'preco' => 189.00,
            'quantidade' => 22,
            'fornecedor_id' => 3,
            'user_id' => 1,
        ],
    ];

        foreach ($produtos as $produto) {
            Produto::create($produto);
        }
    }
}
