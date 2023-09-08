<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BlogPostsChart;
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
        return [
            AccountWidget::class,
            ChangeModule::class,
            BlogPostsChart::class,
        ];
    }
}
