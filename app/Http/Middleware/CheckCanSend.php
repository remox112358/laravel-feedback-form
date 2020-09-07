<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class CheckCanSend
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
        if (! Auth::user()->canSend()) {
            return redirect()
                ->route('home')
                ->with('danger', 'Отправка сообщений возможна не больше 1 раза в сутки');
        }

        return $next($request);
    }
}
