<?php

namespace App\Filament\Resources\AttractionQueueResource\Pages;

use App\Filament\Resources\AttractionQueueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttractionQueues extends ListRecords
{
    protected static string $resource = AttractionQueueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
