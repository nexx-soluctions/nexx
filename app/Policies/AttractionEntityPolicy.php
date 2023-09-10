<?php

namespace App\Policies;

use App\Models\Modules\ComercialAutomation\AttractionEntity;
use App\Models\User;

class AttractionEntityPolicy
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
    public function view(User $user, AttractionEntity $attractionEntity): bool
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
    public function update(User $user, AttractionEntity $attractionEntity): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AttractionEntity $attractionEntity): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AttractionEntity $attractionEntity): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AttractionEntity $card): bool
    {
        return false;
    }
}
