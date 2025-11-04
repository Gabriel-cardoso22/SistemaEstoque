<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'telefone',
        'password',
        'role', // 'gerente' ou 'funcionario'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Helpers
    public function isGerente(): bool
    {
        return $this->role === 'gerente';
    }

    public function isFuncionario(): bool
    {
        return $this->role === 'funcionario';
    }

    // Relações (exemplo)
    public function produtos()
    {
        return $this->hasMany(Produto::class, 'user_id');
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class, 'user_id');
    }
}
