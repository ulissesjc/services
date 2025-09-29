<?php

namespace App\Policies;

use App\Models\School;
use App\Models\User;

class SchoolPolicy
{
    /**
     * Determina se o usuário pode visualizar qualquer modelo.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determina se o usuário pode visualizar qualquer modelo.
     */
    public function view(User $user, School $school): bool
    {
        return true;
    }

    /**
     * Determina se o usuário pode criar modelos.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina se o usuário pode atualizar o modelo.
     */
    public function update(User $user, School $school): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina se o usuário pode excluir o modelo.
     */
    public function delete(User $user, School $school): bool
    {
        return $user->isAdmin();
    }
}
