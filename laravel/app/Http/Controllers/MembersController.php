<?php

namespace App\Http\Controllers;

use App\Event;
use App\Mail\ContactAdmin;
use DB;
use Auth;
use App\User;
use App\Events\NewUser;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ProfileController as Profile;

use App\Http\Controllers\EventController as EventController;

/**
 * @property  user
 */
class MembersController extends Controller
{

    /**
     * @var array
     */
    public $data;
    public $user;

    /**
     * MembersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = new User;

        $this->data = [
            'totalMembers' => $this->user->count(),

        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->data['user'] = Auth::user();
        $this->data['userDaysLeft'] = $this->SubscriptionRemaining($this->data['user']->id);

        if(session('regType') == 'user' && $this->data['user']->lastpayment == null){
            //free limited user add them to the DB
            $exists = DB::table('limited_users')
                ->where('user_id', $this->data['user']->id)
                ->count();
            if($exists <= 0){
                DB::table('users')
                    ->where('id', $this->data['user']->id)
                    ->update([
                    'limited_user' => 1,
                ]);
                //add to limited_users table
                DB::table('limited_users')
                    ->insert([
                        'user_id' => $this->data['user']->id,
                    ]);
            }
        }

        return view('members.landing')->with('data', $this->data);
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function NotAuthorized()
    {
        return view('members.NotAuthorized');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function NotActivated()
    {
        return view('NotActivated');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function MemberDirectory()
    {
        $this->data['user'] = Auth::user();
        $this->data['users'] = DB::table('users')->get()->all();
        $this->data['userDaysLeft'] = $this->SubscriptionRemaining($this->data['user']->id);
        $this->data['states'] = config('colormg.states');
        $this->data['country'] = config('colormg.countries');
        $this->data['industry'] = config('colormg.industry');
        $this->data['position'] = config('colormg.position');
        $this->data['events'] =  EventController::getEvents();

        foreach($this->data['users'] as $user){
            $this->data['followers'][$user->id] = [
                'numFollowers' => count($this->user->findorfail($user->id)->followers),
            ];
        }

        return view('members.directory')->with('data', $this->data);
    }

    public function MemberSearch(Request $request)
    {
        $values = $request->all();

        $this->data['search_values'] = (isset($values['search'])) ? $values : [ 'advanced' => null, 'state' => null, 'country' => null, 'events' => null, 'industry' => null, 'cmg_position' => null, 'speaker_presenter' => null];

        foreach($values as $k=>$v){
            if($v != null && $v != 'null' && $k != '_token' && $k != 'page' && $k != 'search' && $k != 'advanced'){
                $searchValues[$k] = $v;
            }
        }

        $results = DB::table('users');

        if ( isset($searchValues) ) {
            $results = $results->where($searchValues);
        }

        $results = $results->where('activated', 1)
                ->where('deactivated', 0)
                ->where('limited_user', 0)->paginate(10);

        $this->data['user'] = Auth::user();
        $this->data['users'] = $results;
        $this->data['userDaysLeft'] = $this->SubscriptionRemaining($this->data['user']->id);
        $this->data['events'] = EventController::getEvents();
        $this->data['states'] = config('colormg.states');
        $this->data['country'] = config('colormg.countries');
        $this->data['industry'] = config('colormg.industry');
        $this->data['position'] = config('colormg.position');
        $this->data['membership_type'] = config('colormg.membership_type');

        foreach($this->data['users'] as $user){
           /*$this->data['skills'][$user->id] = DB::table('skills')->where('user_id', $user->id)->get();
            if(count($this->data['skills'][$user->id]) < 1){
                $this->data['skills'][$user->id] = 'No Skills Set';
            }*/

            $this->data['followers'][$user->id] = [
                'numFollowers' => count($this->user->findorfail($user->id)->followers),
            ];

        }

        return view('members.directory')->with('data', $this->data);
    }

    public function getSkillsFromDB()
    {
        $skills = DB::table('skills')->distinct();
        dd($skills);
    }

    /**
     * @param $id
     *
     * @return float|int
     */
    public function SubscriptionRemaining($id)
    {
        //days remaining calculation
        if($this->user->find($id)->lastpayment != null) {
            $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($this->user->find($id)->lastpayment))));
            $today = strtotime(date('Y-m-d'));
            $daysLeft = $endingDate - $today;
            return $DaysLeft = round((($daysLeft / 24) / 60) / 60);
        }else{
            return 0;
        }
    }

    public function getFollowers($id)
    {
        //get follow records from DB
        $followers = DB::table('follows')->where('user_id', $id)->get();
        $followers = count($followers);

        return $followers;
    }
    public function getFollowing($id)
    {
        //get follow records from DB
        $following = DB::table('follows')->where('follower_id', $id)->get();
        $following = count($following);

        return $following;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function ResendVerification()
    {
        //fire the new user event, to resend the confirmation email.
        event(new NewUser(Auth::user()));
        return redirect('logout');
    }

    public function Download($filename)
    {
        $path = storage_path('app') . '/memberfiles/'.$filename;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($path, $filename, $headers);
    }

    public function Academic()
    {
        $this->data = [
            'user' => Auth::user(),
        ];

        return view('academic')->with('data', $this->data);
    }

    public function AcademicUpload(Request $request)
    {
        $this->data['user'] = Auth::user();
        $file = $request->file('fileInput');

        $location = $file->store(Auth::id().'/academic_proof');

        $dbStore = DB::table('users')
            ->where('id', Auth::id())
            ->where('isAcademic', 1)
            ->update(['academic_proof' => '/storage/app/public/'.$location]
            );

        $admins = $this->getAdmins();

        //TODO::make this an event at some point.
        foreach($admins as $admin){
            Mail::to($admin)->send(new ContactAdmin($location));
        }

        return view('academicaprovalwait')->with('data', $this->data);
    }

    public function getAdmins()
    {
        $admins = DB::table('users')
            ->where('isAdmin', 1)
            ->get();

        return $admins;
    }
}
