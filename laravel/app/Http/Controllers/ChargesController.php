<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;
use Redirect;
use App\Events;
use Mockery\Exception;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Stripe\Error\Card;

class ChargesController extends Controller
{
public $amount;
public $profile;
public $user;
public $events;

    /**
     * ChargesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->profile = new ProfileController;
        $this->user = new User;
        $this->events = new Events;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //dd(session()->all());
        $user = Auth::user();
        //dd($user);

        if(session('regType') == 'academic' && $user->activated != 1){
            return redirect('/academic-upload');
        }
//dd($user->companyAdmin, session()->get('totalReps'));
        if($user->companyAdmin == 1){

            $compID = DB::table('companies')->where('company_name', $user->company)->value('id');
            //dd($compID);
            session()->put('compLevel', DB::table('companies')->where('id', $compID)->value('company_level'));

            $companyusers = DB::table('company_members')->where('company_id', $compID )->get();
            //dd($companyusers);
            foreach($companyusers as $compuser){
                $cusers[] = $compuser->user_id;
            }
            session()->put('company_users', $cusers);
            //dd(session()->get('company_users'));

            $discount = $this->Discount($user, session()->get('compLevel')); //must be a user object
        }else{

            //dd(session(), 'nope were here.');

            $discount = $this->Discount($user); //must be a user object
        }
//dd($discount);
        return view('payments.stripe_checkout')->with(compact('user', 'discount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Exception|\Illuminate\Http\RedirectResponse|\Mockery\Exception
     */
    public function create(Request $request)
    {
        $isNew = false;
        $user = Auth::user();
        $discount = $this->Discount($user, session()->get('compLevel')); //must be a user object
        //dd($discount);
        try {
            $stripeuser = $user->charge($discount.'00',[
                'email'=>$request->email,
                'currency'=>'usd',
                'description'=>'1 year of membership to ColorMarketing',
                'source'=>$request->stripeToken
            ]);
            //add todays date to lastpayment field in DB

            if(isset($user->lastpayment)) {
                $endingDate = Carbon::parse($user->lastpayment)->addYear(1);
                $today =  Carbon::now();
                $daysLeft = $endingDate->diffInDays($today);

                $finalNewDate = $endingDate->addDays($daysLeft);

            }else{
                $isNew = true;
                $finalNewDate = Carbon::now();
            }

            if(Session::has('compLevel')) {

                if (Session::has('company_users') && session('company_users') != null) {
                    //dd( 'oh NO were here.');
                    //dd(session()->get('company_users'));
                    foreach (session('company_users') as $companyUser) {
                        //dd($companyUser);
                        $companyUser = $this->user->findOrFail($companyUser);
                        //get remaining days to add on

                        if(!$isNew) {
                            DB::table('users')
                                ->where('id', $companyUser->id)
                                ->update(array(
                                    'lastpayment' => $finalNewDate
                                ));
                            DB::table('recentactivity')
                                ->insert([
                                    'user_id' => $companyUser->id,
                                    'activity' => 'Membership Updated By Company, New expiration is ' . $finalNewDate,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                        }else {
                            $finalNewDate = $finalNewDate->addYear(1);
                            DB::table('users')
                                ->where('id', $companyUser->id)
                                ->update(array(
                                    'lastpayment' => $finalNewDate
                                ));
                            DB::table('recentactivity')
                                ->insert([
                                    'user_id' => $companyUser->id,
                                    'activity' => 'Membership Updated By Company, New expiration is ' . $finalNewDate,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                        }
                    }
                }

            }else {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'lastpayment' => $finalNewDate,
                        'lastpaymentamount' => $stripeuser->amount / 100, //amount of transaction in cents
                        'stripe_id' => $stripeuser->id,
                        'card_brand' => $stripeuser->source->brand,
                        'card_last_four' => $stripeuser->source->last4,
                        'updated_at' => Carbon::now(),
                    ]);
            }
            event(new Events\PaymentReceipt(Auth::user(), $discount));
            DB::table('recentactivity')->insert([
                'user_id'       => Auth::id(),
                'activity'      => 'Membership Paid, New expiration is '. $finalNewDate,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);



            return Redirect::to('/regcomplete');

        }catch(Stripe_CardError $e) {
            $error1 = $e->getMessage();
            session()->put('error', $error1);
        }catch (Stripe_InvalidRequestError $e) {
            // Invalid parameters were supplied to Stripe's API
            $error2 = $e->getMessage();
            session()->put('error', $error2);
        } catch (Stripe_AuthenticationError $e) {
            // Authentication with Stripe's API failed
            $error3 = $e->getMessage();
            session()->put('error', $error3);
        } catch (Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed
            $error4 = $e->getMessage();
            session()->put('error', $error4);
        } catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $error5 = $e->getMessage();
            session()->put('error', $error5);
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $error6 = $e->getMessage();
            session()->put('error', $error6);
        } catch (Card $e) {
        }
    }

    /**
     * @param Request $request
     * @return $this
     * @throws \Stripe\Error\Card
     */
    public function EventCharge(Request $request)
    {
        $user = Auth::user();
        //todo:: figure out how long they have consecitivly had there membership.
        try {
            $stripeuser = $user->charge($request->registrationAmount.'00',[
                'email'=>$request->email,
                'currency'=>'usd',
                'description'=>'Registration for '.$request->event_name,
                'source'=>$request->stripeToken,
                'receipt_email' => $request->stripeEmail,
            ]);
            //dd($request, $stripeuser);
            //add todays date to lastpayment field in DB
            $regged = $this->events->create([
                'user_id' => Auth::id(),
                'event_id' => $request->eventID,
                'attendee_type' => $request->registrationType,
                'amount_paid' => $request->registrationAmount,
            ]);
            $data = [
                'meta' =>[
                    'event_name' => $request->event_name,
                    'event_dates'=>[
                        'start' => $request->event_date_start,
                        'end' => $request->event_date_end,
                        ],
                    'event_time' => $request->event_time,
                ]
            ];

            if($regged) {
                event(new Events\EventPaymentReceipt(Auth::user(), $request->registrationAmount, $data['meta']));
                //add to recent activity table
                DB::table('recentactivity')->insert([
                   'user_id'        => Auth::id(),
                   'activity'       => 'Registered for '. $data['meta']['event_name'],
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ]);
                if(isset($request->guestsNum) && $request->guestsNum >=1) {

                    for ($i = 1; $i <= $request->guestsNum; $i++) {
                        switch ($i){
                            case 1;
                                $guests[$i] = $request->guests1;
                                break;
                            case 2;
                                $guests[$i] = $request->guests2;
                                break;
                            case 3;
                                $guests[$i] = $request->guests3;
                                break;
                        }
                    }
                    $guests = implode(',', $guests);

                    DB::table('event_extra_info')->insert([
                        'guests' => $guests,
                    ]);
                }
                return view('events.registered')->with('data', $data);
            }

        }catch(Stripe_CardError $e) {
            $error1 = $e->getMessage();
            session()->put('error', $error1);
        }catch (Stripe_InvalidRequestError $e) {
            // Invalid parameters were supplied to Stripe's API
            $error2 = $e->getMessage();
            session()->put('error', $error2);
        } catch (Stripe_AuthenticationError $e) {
            // Authentication with Stripe's API failed
            $error3 = $e->getMessage();
            session()->put('error', $error3);
        } catch (Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed
            $error4 = $e->getMessage();
            session()->put('error', $error4);
        } catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $error5 = $e->getMessage();
            session()->put('error', $error5);
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $error6 = $e->getMessage();
            session()->put('error', $error6);
        }
    }

    public function Discount($user, $compLevel=0)
    {

        //dd($user, $compLevel);
        //check if there last payment was within the last year
        if($user->companyAdmin == 0) { //&& $user->region == 'North America'
            $amount = '';
            //dd($user->lastpayment);
            $diff = $this->dateCheck($user->lastpayment, 'y');
//dd($diff);
            $thisYear = date('Y');
            if ($diff <= 1 && $user->deactivated != 1 && $user->activated == 1) {

                //check for returning academics
                if($user->isAcademic){
                    $amount = '490';
                }

                //now check for discount amount by how long they have been a member
                $memberlength = $this->dateCheck($user->created_at, 'y');
                //dd($memberlength);
                $cmg_position = DB::table('users')->where('id', Auth::id())->value('cmg_position');
                //dd($memberlength, $amount);
                switch ($memberlength) {
                    case $memberlength == 1;
                        $amount = '730';
                        DB::table('member_level')
                            ->where('id', $user->id)
                            ->update([
                                'member_level' => 1
                            ]);
                        break;
                    case $memberlength == 2;
                        $amount = '730';
                        DB::table('member_level')
                            ->where('id', $user->id)
                            ->update([
                                'member_level' => 1
                            ]);
                        break;
                    case $memberlength == 3;
                        $amount = '730';
                        DB::table('member_level')
                            ->where('id', $user->id)
                            ->update([
                                'member_level' => 1
                            ]);
                        break;
                    case $memberlength == 4;
                        $amount = '670';
                        DB::table('member_level')
                            ->where('id', $user->id)
                            ->update([
                                'member_level' => 2
                            ]);
                        break;
                    case $memberlength == 5;
                        $amount = '635';
                        DB::table('member_level')
                            ->where('id', $user->id)
                            ->update([
                                'member_level' => 3
                            ]);
                        break;
                    case $memberlength >= 6;
                        $amount = '600';
                        DB::table('member_level')
                        ->where('id', $user->id)
                        ->update([
                            'member_level' => 4
                        ]);
                        break;
                }
            }

            if(isset($cmg_position)) {
                if ($cmg_position == 1) {
                    $amount = '560';
                } elseif ($cmg_position == 3) {
                    $amount = '0';
                } elseif ($cmg_position == 4) {
                    $amount = '100';
                }
            }
        }

        if($user->isAcademic){ //&& $user->region == 'North America'
            $amount = '490';

        }

        if($user->companyAdmin == 1){
            //get company level from company table
            switch($compLevel){
                case 2;
                    $amount = '1000';
                    break;
                case 3;
                    $amount = '1375';
                    break;
                case 4;
                    $amount = '1795';
                    break;
                case 5;
                    $amount = '2135';
                    break;
                case 6;
                    $amount = '2510';
                    break;
                case 7;
                    $amount = '2810';
                    break;
                case 8;
                    $amount = '3155';
                    break;
                case 9;
                    $amount = '3490';
                    break;
                case 10;
                    $amount = '3868';
                    break;
            }
        }

        if($user->isAcademic ==0 && $user->companyAdmin ==0) {

            if (!isset($memberlength) || $memberlength <= 3 ) {
                $amount = '730';
            }

            DB::table('member_level')
                ->insert([
                    'user_id' => $user->id,
                    'member_level' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'limited_user' => 0,
                ]);

            return $amount;
        }
        //dd($amount);
        return $amount;
    }

    public function dateCheck($date, $return)
    {
        //dd($date, $return);
        //check if there last payment was within the last year
        $d1 = new DateTime($date);
        $s2  = new DateTime(date('Y-m-d'));
        $diff = $s2->diff($d1)->$return;
//dd($d1, $s2, $diff);
        return $diff;
    }
}
