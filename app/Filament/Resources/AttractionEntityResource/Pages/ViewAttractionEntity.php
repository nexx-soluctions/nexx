<?php

namespace App\Filament\Resources\AttractionEntityResource\Pages;

use App\Filament\Resources\AttractionEntityResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAttractionEntity extends ViewRecord
{
    protected static string $resource = AttractionEntityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
