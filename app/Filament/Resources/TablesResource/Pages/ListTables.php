<?php

namespace App\Filament\Resources\TablesResource\Pages;

use App\Filament\Resources\TablesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTables extends ListRecords
{
    protected static string $resource = TablesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
