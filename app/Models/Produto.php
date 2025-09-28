<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome', 
        'descricao',
        'preco',
        'quantidade',
        'categoria',
        'user_id', // quem cadastrou
        'fornecedor_id', // de quem foi comprado
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Relação: produto foi cadastrado por um usuário.
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id'); // Relação: produto pertence a um fornecedor (por ser apenas um se usa belongsTo).
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class, 'produto_id'); // Relação: um produto tem várias movimentações de estoque (por tervárias movimentações usa-se hasMany).
    }
}