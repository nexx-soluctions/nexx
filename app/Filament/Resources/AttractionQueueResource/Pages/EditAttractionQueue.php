<?php

namespace App\Filament\Resources\AttractionQueueResource\Pages;

use App\Filament\Resources\AttractionQueueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttractionQueue extends EditRecord
{
    protected static string $resource = AttractionQueueResource::class;

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
