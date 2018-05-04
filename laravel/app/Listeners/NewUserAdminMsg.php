<?php

namespace App\Listeners;

use App\Events\NewUser;
use App\Mail\NewUserAdminMsgMail;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NewUserAdminMsg
{
    public $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->user = new User;
    }

    /**
     * Handle the event.
     *
     * @param  NewUser  $event
     * @return void
     */
    public function handle(NewUser $event)
    {
        //
        $admins[] = DB::table('users')
            ->where('isAdmin', 1)->value('id');

        foreach($admins as $admin){
            $admin = $this->user->findOrFail($admin);
            Mail::to($admin)->send(new NewUserAdminMsgMail($admin));
        }

    }
}
