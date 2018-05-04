<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class activated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $activated = DB::table('users')
            ->where('id', Auth::id())
            ->value('activated');

        if($activated != 1)
        {
            return redirect('NotActivated');
        }
        return $next($request);
    }
}
