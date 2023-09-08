<?php

namespace App\Filament\Resources\ChamadoCategoryResource\Pages;

use App\Filament\Resources\ChamadoCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageChamadoCategories extends ManageRecords
{
    protected static string $resource = ChamadoCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
