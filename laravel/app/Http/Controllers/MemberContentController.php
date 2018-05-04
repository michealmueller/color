<?php

namespace App\Http\Controllers;

use App\MemberFiles;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

/**
 * Class MemberContentController
 * @package App\Http\Controllers
 */
class MemberContentController extends Controller
{
    /**
     * @var array
     */
    public $data;


    /**
     * MembersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        /*$this->data= [
            'user'          => Auth::user(),
            'userDaysLeft'  => $this->SubscriptionRemaining(Auth::id()),
            'files'         => MemberFiles::all(),
        ];*/

    }

    public function RovingReports()
    {
    }
    public function ColorReports()
    {
        $this->data['user'] = Auth::user();
        $this->data['userDaysLeft'] = $this->SubscriptionRemaining(Auth::id());
        return view('members.colorforecast')->with('data', $this->data);
    }

    /**
     *
     */
    public function GetContent()
    {
        $this->data= [
            'user'          => Auth::user(),
            'userDaysLeft'  => $this->SubscriptionRemaining(Auth::id()),
            'files'         => MemberFiles::all(),
    ];
        return view('members.memberContent')->with('data', $this->data);
    }

    /**
     * @param $id
     *
     * @return float|int
     */public function SubscriptionRemaining($id)
    {
        //days remaining calculation
        if(User::findOrFail($id)->lastpayment != null) {
            $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime(User::find($id)->lastpayment))));
            $today = strtotime(date('Y-m-d'));
            $daysLeft = $endingDate - $today;
            return $DaysLeft = round((($daysLeft / 24) / 60) / 60);
        }else{
            return 0;
        }
    }

    public function show($id, $page)
    {
        setcookie('user', Auth::user(), 0, "/", '.colormarketing.org');

        /*$password = DB::table('users')
            ->where('id', $id)
            ->value('password');
        setcookie('pass', $password, 0, "/");*/

        if($page === 'digital'){
            $page = 'http://colormarketing.org/digital-color-forecasts/';
        }else{
            $page = 'http://colormarketing.org/roving-color-reports/';
        }
        setcookie('page', $page, 0,"/", '.colormarketing.org');
        /*setcookie('credentials', [
            'username'=>Auth::user()->username,
            'pass'=>DB::table('users')->where('username', Auth::user()->username)->value('password')]
        );*/

        return redirect::to('http://colormarketing.org/test.php');

        /*require '../../colormarketing.org/public_html/wp-load.php';

        if(!username_exists(Auth::user()->username){
            //send them to the login to be added.
            header('Location:http://colormarketing.org/digital-color-forecasts/');
        }else {
            $username = Auth::user()->username;
            $user_id = username_exists($username);
            $userdata = get_userdata($user_id);
            $user = set_current_user($user_id);
            if(isset($_COOKIE['laravel-session'])) {
                do_action('wp_login', $userdata->ID, $user);
            }
            //wp_login($username, $pass);
            //do_action('wp_login', $username, $userdata);

            header('Location:'.$page);
        }*/
    }


}
