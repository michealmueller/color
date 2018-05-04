<?php

namespace App\Http\Middleware;

use App\Mail\AccountExpirationEmail;
use App\User;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class expCheck
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


        $usermodal = new User;
        $user = DB::table('users')->where('email', $request->email)->value('id');
        if($user != null) {
            $user = $usermodal->findOrFail($user);
            if($user->lastpayment != null) {
                $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($user->lastpayment))));
                $today = strtotime(date('Y-m-d'));
                $daysLeft = $endingDate - $today;

                $DaysLeft = round((($daysLeft / 24) / 60) / 60);

                if ($DaysLeft == 30) {
                    //Mail::to($user)->send(new AccountExpirationEmail($user, $DaysLeft));
                } elseif ($DaysLeft == 15) {
                    Mail::to($user)->send(new AccountExpirationEmail($user, $DaysLeft));
                } elseif ($DaysLeft <= 3) {
                    Mail::to($user)->send(new AccountExpirationEmail($user, $DaysLeft));
                }
            }
        }
        return $next($request);
    }
}
