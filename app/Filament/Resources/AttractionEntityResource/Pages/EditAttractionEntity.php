<?php

namespace App\Filament\Resources\AttractionEntityResource\Pages;

use App\Filament\Resources\AttractionEntityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttractionEntity extends EditRecord
{
    protected static string $resource = AttractionEntityResource::class;

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
