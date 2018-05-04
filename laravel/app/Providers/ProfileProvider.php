<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ProfileProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('members.profile.profile', function($view) {
            //days remaining calculation
            $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime(Auth::user()->lastpayment))));
            $today = strtotime(date('Y-m-d'));
            $daysLeft = $endingDate - $today;
            $daysLeft = round((($daysLeft / 24) / 60) / 60);

            //Retrieve all posts by specified user.
            //$timeline = Timeline::whereUser_id(Auth::id());

            //set data for view
            $view->with('daysLeft',$daysLeft);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
