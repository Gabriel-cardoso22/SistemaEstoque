<?php

namespace App\Services;

use App\Models\User;

class RoleService
{
    /**
     * Verifica se o usuário é gerente.
     */
    public static function isGerente(User $user): bool
    {
        return $user->cargo === 'gerente';
    }

    /**
     * Verifica se o usuário é funcionário.
     */
    public static function isFuncionario(User $user): bool
    {
        return $user->cargo === 'funcionario';
    }
}
