<?php

namespace App\Policies;

use App\Models\Modules\ComercialAutomation\Attraction;
use App\Models\User;

class AttractionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (!session()->get('module_connected')) {
            return false;
        }

        return $user->enterprise->modules->contains('acronym', 'ATCM') && session()->get('module_connected')->acronym === 'ATCM';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Attraction $attraction): bool
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
    public function update(User $user, Attraction $attraction): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Attraction $attraction): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Attraction $attraction): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Attraction $card): bool
    {
        return false;
    }
}
