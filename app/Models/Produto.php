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
        'user_id', // quem cadastrou (gerente)
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
