<?php

namespace App\Http\Controllers;

use App\Events;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    //
    public function store($id)
    {

        Events::create([
            'event_id' => $id,
            'user_id' => Auth::id(),
        ]);

        return redirect('/profile');
    }
}
