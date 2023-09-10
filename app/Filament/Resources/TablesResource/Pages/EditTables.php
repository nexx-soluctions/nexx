<?php

namespace App\Filament\Resources\TablesResource\Pages;

use App\Filament\Resources\TablesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTables extends EditRecord
{
    protected static string $resource = TablesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
