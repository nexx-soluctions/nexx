<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Widgets\ChartWidget;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';

    protected function getHeaderWidgets(): array
    {
        return [
            //
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount(): void
    {
        abort_unless(false, 403);
    }
}
