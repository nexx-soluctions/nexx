<?php

namespace App\Filament\Widgets;

use App\Models\Module;
use Filament\Widgets\Widget;

class ChangeModule extends Widget
{
    public function changeModule(string $acronym): void
    {
        if (auth()->user()->enterprise->modules->contains('acronym', $acronym)) {
            $modulo = auth()->user()->enterprise->modules->first(function ($module) use ($acronym) {
                return $module->acronym === $acronym;
            });

            $modulo->signModule();
        }

        $this->dispatch('filament-change-module');

        $this->redirect(request()->header('Referer'));

    }

    protected static string $view = 'filament.widgets.change-module';
}
