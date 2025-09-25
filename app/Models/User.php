<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'cargo', // gerente ou funcionario
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Verifica se é gerente
     */
    public function isGerente(): bool
    {
        return $this->cargo === 'gerente';
    }

    /**
     * Verifica se é funcionário
     */
    public function isFuncionario(): bool
    {
        return $this->cargo === 'funcionario';
    }

    /**
     * Relação: um gerente pode cadastrar produtos
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class, 'user_id');
    }
}
