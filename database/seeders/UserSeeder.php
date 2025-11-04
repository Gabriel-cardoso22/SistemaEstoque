<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Usuário Gerente',
                'email' => 'gerente@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'gerente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Usuário Funcionário',
                'email' => 'funcionario@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'funcionario',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
