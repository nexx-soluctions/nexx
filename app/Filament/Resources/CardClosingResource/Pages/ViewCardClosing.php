<?php

namespace App\Filament\Resources\CardClosingResource\Pages;

use App\Filament\Resources\CardClosingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCardClosing extends ViewRecord
{
    protected static string $resource = CardClosingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
