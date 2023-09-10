<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Amendozaaguiar\FilamentRouteStatistics\FilamentRouteStatisticsPlugin;
use App\Filament\Auth\Login;
use App\Filament\Pages\Dashboard;
use App\Filament\Pages\HealthCheckResults;
use BezhanSalleh\FilamentExceptions\Facades\FilamentExceptions;
use BezhanSalleh\FilamentExceptions\FilamentExceptionsPlugin;
use BezhanSalleh\FilamentLanguageSwitch\FilamentLanguageSwitchPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Vite;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use RickDBCN\FilamentEmail\FilamentEmail;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use Tapp\FilamentAuthenticationLog\FilamentAuthenticationLogPlugin;

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
                ->label('Links'),
            NavigationGroup::make()
                ->label('Estatísticas')
        ];
    }

    private function getPanelNavigationItems(): array
    {
        return [
            NavigationItem::make('suporte.dev')
                ->url('https://suporte.dev', true)
                ->icon('heroicon-o-arrow-top-right-on-square')
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
            FilamentRouteStatisticsPlugin::make(),
            FilamentAuthenticationLogPlugin::make(),
            FilamentExceptionsPlugin::make(),
            // new FilamentEmail,
            FilamentSpatieRolesPermissionsPlugin::make(),
            FilamentSpatieLaravelHealthPlugin::make()
                ->usingPage(HealthCheckResults::class),
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
            ->userMenuItems([
                // MenuItem::make()
                // ->label('Preferências')
                // ->icon('heroicon-o-cog-6-tooth'),
                'logout' => MenuItem::make()->label('Sair'),
            ])
            // ->tenant(Enterprise::class)
            // ->tenantMiddleware([
            //     ApplyTenantScopes::class,
            // ], isPersistent: true)
    
            // ->requiresTenantSubscription()
            // ->tenantMenuItems([
            //     MenuItem::make()
            //         ->label('Settings')
            //         ->icon('heroicon-m-cog-8-tooth'),
            //     // ...
            // ])
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
