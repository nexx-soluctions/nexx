<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Login;
use App\Filament\Pages\Dashboard;
use BezhanSalleh\FilamentLanguageSwitch\FilamentLanguageSwitchPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Vite;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    private function getPanelNavigationGroups(): array
    {
        return [
            NavigationGroup::make()
                ->label('Chamados')
                ->collapsed(),
            NavigationGroup::make()
                ->label('Gerenciamento'),
            NavigationGroup::make()
                ->label('Links')
                ->icon('heroicon-o-arrow-top-right-on-square'),
        ];
    }

    private function getPanelNavigationItems(): array
    {
        return [
            NavigationItem::make('Empresas')
                ->icon('heroicon-o-building-office')
                ->badge('Em breve')
                ->group('Gerenciamento'),
            NavigationItem::make('Módulos')
                ->icon('heroicon-o-table-cells')
                ->badge('Em breve')
                ->group('Gerenciamento'),
            NavigationItem::make('Usuários')
                ->icon('heroicon-o-users')
                ->badge('Em breve')
                ->group('Gerenciamento'),
            NavigationItem::make('Papéis')
                ->icon('heroicon-o-square-3-stack-3d')
                ->badge('Em breve')
                ->group('Gerenciamento'),
            NavigationItem::make('Permissões')
                ->icon('heroicon-o-shield-check')
                ->badge('Em breve')
                ->group('Gerenciamento'),
            NavigationItem::make('suporte.dev')
                ->url('https://suporte.dev', true)
                ->group('Links'),
        ];
    }

    /**
     * Retorna todos os pluguins do painel.
     *
     * @return array
     */
    private function getPanelPluguins(): array
    {
        return [
            FilamentLanguageSwitchPlugin::make()->renderHookName('panels::user-menu.before'),
        ];
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('')
            ->login(Login::class)
            ->passwordReset()
            ->colors(['primary' => Color::Blue])
            ->favicon(Vite::asset('resources/images/logo.png'))
            ->databaseNotifications()
            ->databaseNotificationsPolling('15s')
            ->font('Figtree')
            ->sidebarCollapsibleOnDesktop()
            // ->topNavigation()
            ->navigationItems($this->getPanelNavigationItems())
            ->navigationGroups($this->getPanelNavigationGroups())
            ->pages([
                Dashboard::class,
            ])
            ->plugins($this->getPanelPluguins())
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages');
    }
}
