<?php

namespace App\Http\Controllers;

use App\Follow;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FollowsController extends Controller
{
    public $follower;
    public $user;
    //

    public function __construct()
    {
     $this->follower = new Follow;
     $this->user = new User;
    }

    public function store($id)
    {

        $following = DB::table('follows')
            ->where('user_id', Auth::id())
            ->where('follower_id', $id)
            ->count();
        if($following <= 0) {
            $this->follower->create([
                'user_id' => Auth::id(),
                'follower_id' => $this->user->findOrFail($id)->id
            ]);
            session()->put('success', 'You are now following '. $this->user->findorfail($id)->firstname);
        }else{
            session()->put('error', 'You are already following '. $this->user->findorfail($id)->firstname);
        }

        return redirect('/profile');
    }
}
