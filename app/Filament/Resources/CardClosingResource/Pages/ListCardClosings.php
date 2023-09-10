<?php

namespace App\Filament\Resources\CardClosingResource\Pages;

use App\Filament\Resources\CardClosingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCardClosings extends ListRecords
{
    protected static string $resource = CardClosingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
