<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Amendozaaguiar\FilamentRouteStatistics\FilamentRouteStatisticsPlugin;
use App\Filament\Auth\Login;
use App\Filament\Pages\Dashboard;
use App\Http\Middleware\EnterpriseMiddleware;
use App\Http\Middleware\ModuleMiddleware;
use App\Http\Middleware\NavigationItemsMiddleware;
use BezhanSalleh\FilamentLanguageSwitch\FilamentLanguageSwitchPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Vite;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    private function getPanelNavigationGroups(): array
    {
        return [
            NavigationGroup::make()
                ->label('Extrato'),
            NavigationGroup::make()
                ->label('Pagamentos'),
            NavigationGroup::make()
                ->label('Pedidos'),
            NavigationGroup::make()
                ->label('Atrações'),
            NavigationGroup::make()
                ->label('Extras'),
            NavigationGroup::make()
                ->label('Chamados'),
            NavigationGroup::make()
                ->label('Gerenciamento'),
            NavigationGroup::make()
                ->label('Estatísticas'),
            NavigationGroup::make()
                ->label('Links'),
        ];
    }

    private function getPanelNavigationItems(): array
    {
        return [
            // NavigationItem::make('suporte.dev')
            //     ->url('https://suporte.dev', true)
            //     ->icon('heroicon-o-arrow-top-right-on-square')
            //     ->group('Links')
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
            // new FilamentEmail,
            FilamentLanguageSwitchPlugin::make()->renderHookName('panels::user-menu.before'),
            FilamentRouteStatisticsPlugin::make(),
            // FilamentAuthenticationLogPlugin::make(),
            // FilamentExceptionsPlugin::make(),
            FilamentSpatieRolesPermissionsPlugin::make(),
            // FilamentSpatieLaravelHealthPlugin::make()
            //     ->usingPage(HealthCheckResults::class),
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
                EnterpriseMiddleware::class,
                ModuleMiddleware::class,        
            ])
            ->authMiddleware([
                Authenticate::class,
                NavigationItemsMiddleware::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages');
    }
}
