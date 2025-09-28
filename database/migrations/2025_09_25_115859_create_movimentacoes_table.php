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
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos');
            $table->foreignId('user_id')->constrained('users'); // Usuário que realizou a ação
            $table->enum('tipo', ['entrada', 'saida']);
            $table->unsignedInteger('quantidade'); // Quantidade que entrou ou saiu
            $table->text('observacao')->nullable(); // Ex: "Venda para cliente X", "Ajuste de estoque"
            $table->timestamps(); // A data da movimentação será o created_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacoes');
    }
};