<?php

namespace App\Filament\Pages;

use Illuminate\Contracts\Support\Htmlable;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults as BaseHealthCheckResults;

class HealthCheckResults extends BaseHealthCheckResults
{
    protected static ?string $navigationIcon = 'heroicon-o-heart';

    public function getHeading(): string | Htmlable
    {
        return __('Saúde da Aplicação');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Estatísticas');
    }
}
