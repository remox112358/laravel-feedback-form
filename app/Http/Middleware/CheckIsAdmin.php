<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (! Auth::user()->isAdmin()) {
            return redirect()
                    ->route('home')
                    ->with('danger', 'У вас нет прав администратора.');
        }

        return $next($request);
    }
}
