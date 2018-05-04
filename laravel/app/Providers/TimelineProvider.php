<?php

namespace App\Providers;

use App\Timeline;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class TimelineProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //get timeline data for profile view

        view()->composer('members.profile.profile', function($view){

            //Retrieve all posts by specified user.
            $timeline = Timeline::whereUser_id(Auth::id());

            //set data for view
            $view->with('data', $timeline = [
                'timeline'      => $timeline,
            ]);
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
