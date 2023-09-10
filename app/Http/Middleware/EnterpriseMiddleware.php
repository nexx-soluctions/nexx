<?php

namespace App\Http\Middleware;

use App\Models\Enterprise;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnterpriseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()) {
            if (is_null(Session::get('enterprise_connected'))) {
                auth()->user()->enterprise->connect(false);
            } else {
                if (DB::connection('db_enterprise')->getDatabaseName() != auth()->user()->enterprise->db_url) {
                    auth()->user()->enterprise->connect(false);
                }
            }
        }

        return $next($request);
    }
}
