<?php

namespace App\Policies;

use App\Models\Modules\ComercialAutomation\AttractionQueue;
use App\Models\User;

class AttractionQueuePolicy
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
    public function view(User $user, AttractionQueue $attractionQueue): bool
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
    public function update(User $user, AttractionQueue $attractionQueue): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AttractionQueue $attractionQueue): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AttractionQueue $attractionQueue): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AttractionQueue $card): bool
    {
        return false;
    }
}
