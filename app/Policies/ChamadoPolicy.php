<?php

namespace App\Policies;

use App\Models\Chamado;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChamadoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (!session()->get('module_connected')) {
            return false;
        }

        return $user->enterprise->modules->contains('acronym', 'CHMD') && session()->get('module_connected')->acronym === 'CHMD';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Chamado $chamado): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chamado $chamado): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chamado $chamado): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Chamado $chamado): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Chamado $chamado): bool
    {
        return false;
    }
}
