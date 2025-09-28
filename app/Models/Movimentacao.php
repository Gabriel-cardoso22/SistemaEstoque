<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    protected $table = 'movimentacoes';

    protected $fillable = [
        'produto_id',
        'user_id',
        'tipo',
        'quantidade',
        'observacao',
    ];


    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id'); // Relação: uma movimentação pertence a um produto.
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Relação: uma movimentação foi registrada por um usuário.
    }
}