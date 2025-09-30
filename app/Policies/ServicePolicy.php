<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;

class ServicePolicy
{
    /**
     * Determina se o usuário pode visualizar qualquer modelo.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determina se o usuário pode visualizar o modelo.
     */
    public function view(User $user, Service $service): bool
    {
        return true;
    }

    /**
     * Determina se o usuário pode criar modelos.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determina se o usuário pode atualizar o modelo.
     */
    public function update(User $user, Service $service): bool
    {
        return $user->id === $service->user_id;
    }

    /**
     * Determina se o usuário pode excluir o modelo.
     */
    public function delete(User $user, Service $service): bool
    {
        if ($user->id === $service->user_id) {
            return true;
        }

        if ($user->isAdmin() && !$service->user->isAdmin()) {
            return true;
        }

        return false;
    }
}
