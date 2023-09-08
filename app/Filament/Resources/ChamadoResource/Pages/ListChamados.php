<?php

namespace App\Filament\Resources\ChamadoResource\Pages;

use App\Filament\Resources\ChamadoResource;
use App\Filament\Widgets\BlogPostsChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChamados extends ListRecords
{
    protected static string $resource = ChamadoResource::class;

    protected function getFooterWidgets(): array
    {
        return [
            BlogPostsChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}