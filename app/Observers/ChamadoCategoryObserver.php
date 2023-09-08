<?php

namespace App\Observers;

use App\Models\ChamadoCategory;

class ChamadoCategoryObserver
{
    /**
     * Handle the ChamadoCategory "created" event.
     */
    public function created(ChamadoCategory $chamadoCategory): void
    {
        //
    }

    /**
     * Handle the ChamadoCategory "updated" event.
     */
    public function updated(ChamadoCategory $chamadoCategory): void
    {
        //
    }

    /**
     * Handle the ChamadoCategory "deleted" event.
     */
    public function deleted(ChamadoCategory $chamadoCategory): void
    {
        //
    }

    /**
     * Handle the ChamadoCategory "restored" event.
     */
    public function restored(ChamadoCategory $chamadoCategory): void
    {
        //
    }

    /**
     * Handle the ChamadoCategory "force deleted" event.
     */
    public function forceDeleted(ChamadoCategory $chamadoCategory): void
    {
        //
    }
}
