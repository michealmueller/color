<?php

namespace App\Console\Commands;

use App\Events\AccountExpiration;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SubscriptionCheck extends Command
{
    public $user;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sub:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all Users subscription status and send out emails accordingly.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->user = new User;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        $users = DB::table('users')->get()->all();

        foreach ($users as $user){
            $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($user->lastpayment))));
            $today = strtotime(date('Y-m-d'));
            $daysLeft = $endingDate - $today;
            $DaysLeft = round((($daysLeft / 24) / 60) / 60);

            if($DaysLeft == 30){
                //event(new AccountExpiration($this->user->find($user->id), $DaysLeft));
                echo 'Email Dispatched to '.$user->firstname. ' '. $user->lastname,' With '.$DaysLeft.' Days Left.\n';
            }elseif($DaysLeft == 15){
                //event(new AccountExpiration($this->user->find($user->id), $DaysLeft));
                echo 'Email Dispatched to '.$user->firstname. ' '. $user->lastname,' With '.$DaysLeft.' Days Left.';
            }elseif($daysLeft <= 3){
                //event(new AccountExpiration($this->user->find($user->id), $DaysLeft));
                echo 'Email Dispatched to '.$user->firstname. ' '. $user->lastname,' With '.$DaysLeft.' Days Left.';
            }
        }
    }
}
