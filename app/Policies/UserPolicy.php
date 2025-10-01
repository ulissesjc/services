<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determina se o usuário pode visualizar qualquer modelo.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina se o usuário pode visualizar o modelo.
     */
    public function view(User $user, User $model): bool
    {
        return $user->isAdmin() || $user->id === $model->id;
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
    public function update(User $user, User $model): bool
    {
        return ($user->isAdmin() && !$model->isAdmin()) || $user->id === $model->id;
    }

    /**
     * Determina se o usuário pode excluir o modelo.
     */
    public function delete(User $user, User $model): bool
    {
        if ($user->isAdmin() && !$model->isAdmin()) {
            return true;
        }

        return false;
    }
}
