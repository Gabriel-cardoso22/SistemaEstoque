<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';

    protected $fillable = [
        'nome',
        'cnpj',
        'email',
        'telefone',
        'endereco',
    ];

    /**
     * Relação: um fornecedor pode ter vários produtos.
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class, 'fornecedor_id');
    }
}