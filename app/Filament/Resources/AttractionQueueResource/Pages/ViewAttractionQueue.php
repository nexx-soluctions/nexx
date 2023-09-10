<?php

namespace App\Filament\Resources\AttractionQueueResource\Pages;

use App\Filament\Resources\AttractionQueueResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAttractionQueue extends ViewRecord
{
    protected static string $resource = AttractionQueueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
