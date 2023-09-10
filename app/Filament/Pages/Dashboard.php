<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ChamadosChart;
use App\Filament\Widgets\ChangeModule;
use Filament\Pages\Dashboard as BasePage;
use Filament\Widgets\AccountWidget;

class Dashboard extends BasePage
{
    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        $widgets = [
            AccountWidget::class,
            ChangeModule::class,
        ];

        $modulo = session()->get('module_connected')->acronym;

        if ($modulo === 'CHMD') {
            $widgets = array_merge($widgets, [
                ChamadosChart::class,
            ]);
        }

        return $widgets;
    }
}
