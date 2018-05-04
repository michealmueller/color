<?php

namespace App\Http\Middleware;

use Auth;
use App\User;
use Closure;

class CheckForSubscription
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
        $user = Auth::user();
        if($user) {
            $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($user->lastpayment))));
            $today = strtotime(date('Y-m-d'));
            $daysLeft = $endingDate - $today;
            $DaysLeft = round((($daysLeft / 24) / 60) / 60);
            if ($DaysLeft < 0) {
                if ($user->paybycheck == false) {
                    return redirect('NewSubscription');
                } else {
                    return $next($request);
                }
            }
        }

        return $next($request);
    }
}
