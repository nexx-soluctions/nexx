<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NavigationItemsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->get('module_connected') && session()->get('module_connected')->acronym === 'ATCM') {
            Filament::registerNavigationItems([
                NavigationItem::make('Portal do Garçom')
                    ->url('/atcm/waiter', true)
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->group('Links')
            ]);
        }

        return $next($request);
    }
}
