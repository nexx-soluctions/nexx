<?php

namespace App\Filament\Resources\AttractionEntityResource\Pages;

use App\Filament\Resources\AttractionEntityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttractionEntities extends ListRecords
{
    protected static string $resource = AttractionEntityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
