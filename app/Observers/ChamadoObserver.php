<?php

namespace App\Observers;

use App\Models\Chamado;

class ChamadoObserver
{
    public function creating(Chamado $chamado): void
    {
        $chamado->created_by = auth()->user()->username;
        $chamado->updated_by = auth()->user()->username;
    }

    public function updating(Chamado $chamado): void
    {
        $chamado->updated_by = auth()->user()->username;
    }

    /**
     * Handle the Chamado "created" event.
     */
    public function created(Chamado $chamado): void
    {
        //
    }

    /**
     * Handle the Chamado "updated" event.
     */
    public function updated(Chamado $chamado): void
    {
        //
    }

    /**
     * Handle the Chamado "deleted" event.
     */
    public function deleted(Chamado $chamado): void
    {
        //
    }

    /**
     * Handle the Chamado "restored" event.
     */
    public function restored(Chamado $chamado): void
    {
        //
    }

    /**
     * Handle the Chamado "force deleted" event.
     */
    public function forceDeleted(Chamado $chamado): void
    {
        //
    }
}
