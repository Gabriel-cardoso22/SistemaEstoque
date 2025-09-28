<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2); // Melhor para valores monetários
            $table->unsignedInteger('quantidade')->default(0); // Estoque atual
            $table->string('categoria')->nullable();

            // Chave estrangeira para o usuário que cadastrou o produto
            $table->foreignId('user_id')->constrained('users');

            // Chave estrangeira para o fornecedor do produto (pode ser nulo)
            $table->foreignId('fornecedor_id')->nullable()->constrained('fornecedores');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};