<?php

namespace App\Http\Controllers\Auth;

use App\Company;
use App\Events\CompUser;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Events\NewUser;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{

    public $user;
    public $company;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/NewSubscription';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->user = new User;
        $this->company = new Company;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
         session()->put(['regType'=>$data['regType']]);
        if($data['regType'] == 'user') {
            return Validator::make($data, [
                'firstname' => 'required|min:3',
                'lastname'  => 'required|min:3',
                'username'  => 'required|unique:users,username|min:3',
                'email'     => 'required|email|unique:users,email',
                'company'   => 'required',
                'compweb'   => 'required',
                'industry'  => 'required',
                'prod'      => 'required',
                'city'      => 'required',
                'state'     => 'required',
                'zip'       => 'required',
                'country'   => 'required',
                'password'  => 'required|min:6|confirmed',
                'consumer'  => 'required_without:contract',
                'contract'  => 'required_without:consumer',
            ]);
        }elseif($data['regType'] == 'academic'){
            return Validator::make($data, [
                'firstname' => 'required|min:3',
                'lastname'  => 'required|min:3',
                'username'  => 'required|unique:users,username|min:3',
                'email'     => 'required|email|unique:users,email',
                'company'   => 'required',
                'password'  => 'required|min:6|confirmed',
                ]);
        }else{
            $arr_validator_conditions = Array();
            for($i=1; $i <= $data['totalReps']; $i++) {
                $arr_validator_conditions['firstname'.$i]  = 'required|min:3';
                $arr_validator_conditions['lastname'.$i]  = 'required|min:3';
                $arr_validator_conditions['username'.$i]   = 'required|unique:users,username|min:3';
                $arr_validator_conditions['email'.$i] = 'required|email|max:255|unique:users,email';
                $arr_validator_conditions['password'.$i] = 'required|min:6';
            }
            $arr_validator_conditions['consumer'] = 'required_without:contract';
            $arr_validator_conditions['contract'] = 'required_without:consumer';
            $arr_validator_conditions['company'] = 'required|unique:companies,company_name';
            return Validator::make($data, $arr_validator_conditions);
        }
    }

    protected function create(array $data)
    {
        //dd($data);
        session()->put(['regType'=>$data['regType']]);
        $compLevel = '';
        if($data['regType'] == 'company'){
            //get company level
            session()->put(['totalReps' => $data['totalReps']]);
            switch ($data['totalReps']){
                case 2;
                    $compLevel = '2';
                    break;
                case 3;
                    $compLevel = '3';
                    break;
                case 4;
                    $compLevel = '4';
                    break;
                case 5;
                    $compLevel = '5';
                    break;
                case 6;
                    $compLevel = '6';
                    break;
                case 7;
                    $compLevel = '7';
                    break;
                case 8;
                    $compLevel = '8';
                    break;
                case 9;
                    $compLevel = '9';
                    break;
                case 10;
                    $compLevel = '10';
                    break;
            }

            for($i=1; $i <= $data['totalReps']; $i++){
                if($data['industry'] === 'other'){
                    $data['industry'] = $data['otherIndustry'];
                }
                $users[] = $this->user->create([
                    'firstname'         => $data['firstname'.$i],
                    'lastname'          => $data['lastname'.$i],
                    'username'          => $data['username'.$i],
                    'company'           => $data['company'],
                    'email'             => $data['email'.$i],
                    'industry'          => $data['industry'],
                    'hash'              => sha1($data['email'.$i]),
                    'password'          => bcrypt($data['password'.$i]),
                    'gravatar'          => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($data['email'.$i]))) . '?s=167&d=identicon',
                    'updated_at'        => Carbon::now(),
                    //'region' => $this->getRegion($data['region']),
                ]);
                //make first user company admin
                DB::table('users')
                    ->where('id', $users[0]->id)
                    ->update([
                        'companyAdmin' => 1,
                    ]);

                $userID[] = DB::table('users')
                    ->where('username', $data['username'.$i])
                    ->value('id');

                event(new NewUser($users[$i-1]));
                event(new CompUser($users[$i-1], $data['password'.$i]));
            }
            session(['company_users'=>$userID]);
            //dd($compLevel);
            //gather all consumer, contract values and make comma separated list.
            if(isset($data['consumer'])) {
                $consumer = implode(',', $data['consumer']);
                $company = $this->company->create([
                    'company_name' => $data['company'],
                    'company_address' => $data['compaddress'],
                    'phone' => $data['compphone'],
                    'city' => $data['compcity'],
                    'state' => $data['compstate'],
                    'zip' => $data['compzip'],
                    'country' => $data['compcountry'],
                    'fax' => $data['compfax'],
                    'company_level' => $compLevel,
                    'consumer' => $consumer,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }elseif(isset($data['contract'])) {
                $contract = implode(',', $data['contract']);
                $company = $this->company->create([
                    'company_name' => $data['company'],
                    'company_address' => $data['compaddress'],
                    'phone' => $data['compphone'],
                    'city' => $data['compcity'],
                    'state' => $data['compstate'],
                    'zip' => $data['compzip'],
                    'country' => $data['compcountry'],
                    'fax' => $data['compfax'],
                    'company_level' => $compLevel,
                    'contract' => $contract,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            $compID = DB::table('companies')
                ->where('company_name', $data['company'])
                ->value('id');

            foreach($userID as $id){
                $exists = DB::table('company_members')->where('user_id', $id)->count();
                if($exists <= 0){
                    DB::table('company_members')->insert([
                        'company_id'    => $compID,
                        'user_id'       => $id,
                        'created_at'    => Carbon::now(),
                    ]);
                }

            }
            //set seesion variable so we know how many reps there are for price adjustment.
            session()->put('totalReps', $data['totalReps']);

            //return the first user to log them in.
            return $users[0];

        }elseif($data['regType'] == 'academic'){
            //create the user but do not send activation email, admin will activate account
            //when employment is verified, after activation send email notifying.

            session(['regType' => 'academic']);
            //$region = $this->getRegion($data['region']);

            $acaUser = $this->user->create([
                'firstname'         => $data['firstname'],
                'lastname'          => $data['lastname'],
                'username'          => $data['username'],
                'email'             => $data['email'],
                'hash'              => sha1($data['email']),
                'password'          => Hash::make($data['password']),
                'gravatar'          => '/storage/app/public/default_avatar.jpeg',
                //'region'          => $region,
                'isAcademic'        => 1,
                'updated_at'        => Carbon::now(),
            ]);

            return $acaUser;

        }else {
            //$region = $this->getRegion($data['region']);
            //dd($data);
            //gather all consumer, contract values and make comma seperated list.
            if(isset($data['consumer'])) {
                if($data['industry'] === 'other'){
                    $data['industry'] = $data['otherIndustry'];
                }
                if($data['position'] === 'other'){
                    $data['position'] = $data['otherPosition'];
                }
                $consumer = implode(',', $data['consumer']);
                $user = $this->user->create([
                    'firstname'         => $data['firstname'],
                    'lastname'          => $data['lastname'],
                    'username'          => $data['username'],
                    'email'             => $data['email'],
                    'state'             => $data['state'],
                    'city'              => $data['city'],
                    'zip'               => $data['zip'],
                    'country'           => $data['country'],
                    'company'           => $data['company'],
                    'compweb'           => $data['compweb'],
                    'industry'          => $data['industry'],
                    'position'          => $data['position'],
                    'products_services' => $data['prod'],
                    'consumer'          => $consumer,
                    'hash'              => sha1($data['email']),
                    'password'          => Hash::make($data['password']),
                    'gravatar'          => '/storage/app/public/default_avatar.jpeg',
                    'updated_at'        => Carbon::now(),
                ]);
            }elseif(isset($data['contract'])) {
                if($data['industry'] === 'other'){
                    $data['industry'] = $data['otherIndustry'];
                }
                if($data['position'] === 'other'){
                    $data['position'] = $data['otherPosition'];
                }
                $contract = implode(',', $data['contract']);
                $user = $this->user->create([
                    'firstname'         => $data['firstname'],
                    'lastname'          => $data['lastname'],
                    'username'          => $data['username'],
                    'email'             => $data['email'],
                    'state'             => $data['state'],
                    'city'              => $data['city'],
                    'zip'               => $data['zip'],
                    'country'           => $data['country'],
                    'company'           => $data['company'],
                    'compweb'           => $data['compweb'],
                    'industry'          => $data['industry'],
                    'position'          => $data['position'],
                    'products_services' => $data['prod'],
                    'contract'          => $contract,
                    'hash'              => sha1($data['email']),
                    'password'          => Hash::make($data['password']),
                    'gravatar'          => '/storage/app/public/default_avatar.jpeg',
                    'updated_at'        => Carbon::now(),
                ]);
            }


            //set the session information for the authed user
            if (Auth::check()) {
                session(['AuthedUser' => $this->user->find(Auth::id())]);
            }

            //if the user is created fire the event to send out an email so they can verify the account.
            if ($user) {
                event(new NewUser($user));
            }
            //check if they want the newsletter,
            if(isset($data['newsletter']) && $data['newsletter'] == 1) {
                //TODO::sign them up for the newsletter
            }

            return $user;
        }
    }
    /**
     * @param $region
     *
     * @return string
     */
    public function getRegion($region)
    {
        switch ($region){
            case 'na';
                $userRegion = 'North America';
                break;
            case 'asiapc';
                $userRegion = 'Asia Pacific';
                break;
            case 'euro';
                $userRegion = 'European';
                break;
            case 'latin';
                $userRegion = 'Latin America';
                break;
        }
            return $userRegion;
    }
}
