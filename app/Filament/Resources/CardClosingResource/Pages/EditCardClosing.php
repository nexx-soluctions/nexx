<?php

namespace App\Filament\Resources\CardClosingResource\Pages;

use App\Filament\Resources\CardClosingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCardClosing extends EditRecord
{
    protected static string $resource = CardClosingResource::class;

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
