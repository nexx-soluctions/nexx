<?php

namespace App\Filament\Resources\TablesResource\Pages;

use App\Filament\Resources\TablesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTables extends ViewRecord
{
    protected static string $resource = TablesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
