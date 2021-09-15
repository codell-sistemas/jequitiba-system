<?php

namespace App\Http\Middleware;

use App\Estabelecimento;
use Closure;

class CheckTenant
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Extract the subdomain from URL.
        list($subdomain) = explode('.', $request->getHost(), 2);

        // Retrieve requested tenant's info from database. If not found, abort the request.
        $tenant = Estabelecimento::where('slug', $subdomain)->firstOrFail();

        dd($tenant);

        // Store the tenant info into session.
        $request->session()->put('tenant', $tenant);

        return $next($request);
    }
}
