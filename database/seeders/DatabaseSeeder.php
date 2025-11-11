<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // A ordem importa!
        $this->call([
            UserSeeder::class,
            FornecedorSeeder::class,
            ProdutoSeeder::class,
        ]);
    }
}
