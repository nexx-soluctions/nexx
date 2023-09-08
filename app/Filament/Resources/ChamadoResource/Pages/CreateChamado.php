<?php

namespace App\Filament\Resources\ChamadoResource\Pages;

use App\Filament\Resources\ChamadoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateChamado extends CreateRecord
{
    protected static string $resource = ChamadoResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Chamado registrado no nosso banco de dados!')
            ->body('Analisaremos e entraremos em contato o mais breve possível.');
    }

}
