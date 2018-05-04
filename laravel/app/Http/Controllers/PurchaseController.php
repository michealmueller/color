<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public $user;
    public $profile;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->profile = new ProfileController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return the stripe form
        return view('payments.stripe_checkout');
    }

    public function CancelSubscriptionIndex()
    {
        return view('payments.CancelSubscription');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Subscribe(Request $request)
    {
        //
        $request->user()->newSubscription('main', 'Yearly')
            ->create($request->stripeToken,
                [
                    'email'=>$request->user()->email
                ]);
        return redirect('ThankYou');
    }

    public function RegComplete()
    {
        $userData = [
            'user'          => Auth::user(),
            'userDaysLeft'  => $this->profile->SubscriptionRemaining(Auth::id()),
        ];
        return view('payments.regcomplete')->with('data', $userData);
    }
    public function ThankYou()
    {
        $userData = [
            'user'          => Auth::user(),
            'userDaysLeft'  => $this->profile->SubscriptionRemaining(Auth::id()),
        ];

        return view('payments.thankyou')->with('data', $userData);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CancelSubscription(Request $request)
    {
        //Cancel the users Subscription
        $request->user()->subscription('main')->cancel();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
