<?php

namespace App;

use Illuminate\Auth\Passwords\CanResetPassword;
use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laravel\Passport\HasApiTokens;

/**
 * App\User
 *
 * @property int $id
 * @property int $isAdmin
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $instagram
 * @property string|null $linkedin
 * @property \App\Company $company
 * @property string|null $position
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $gravatar
 * @property string|null $address
 * @property string|null $bio
 * @property string|null $country
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property string $password
 * @property int $activated
 * @property int|null $deactivated
 * @property int|null $cmg_position
 * @property string|null $hash
 * @property int|null $speaker_presenter
 * @property string|null $material
 * @property string|null $website
 * @property string|null $industry
 * @property string|null $products_services
 * @property string|null $lastpayment
 * @property float|null $lastpaymentamount
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property string|null $stripe_id
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property string|null $trial_ends_at
 * @property int|null $paybycheck
 * @property string|null $region
 * @property int $isAcademic
 * @property string|null $academic_proof
 * @property int $companyAdmin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comments[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Events[] $events
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Follow[] $followers
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\Subscription[] $subscriptions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Timeline[] $timeline
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAcademicProof($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCmgPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCompanyAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeactivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGravatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsAcademic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastpayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastpaymentamount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereMaterial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePaybycheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereProductsServices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSpeakerPresenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $membership_type
 * @property string|null $compweb
 * @property string|null $consumer
 * @property string|null $contract
 * @property int $limited_user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCompweb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereConsumer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereContract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLimitedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereMembershipType($value)
 */
class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    use SoftDeletes;
    use SearchableTrait;
    use HasApiTokens;
    use CanResetPassword;

    //searchable trait stuff
    protected $searchable = [
        'columns' => [
            'users.firstname'   => 1,
            'users.lastname'    => 1,
            'users.region'      => 10,
            'users.username'    => 2,
            'users.email'       => 3,
            'users.skills'      => 8,
            'users.company'     => 3,
            'users.position'    => 5,
            'users.city'        => 4,
            'users.state'       => 4,
            'users.country'     => 6,

        ],
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'username', 'company', 'position', 'phone', 'email', 'address', 'password', 'hash', 'gravatar',
        'zip', 'skills', 'country', 'city', 'state', 'bio', 'notes', 'region', 'consumer', 'contract', 'isAcademic', 'isAdmin',
        'activated', 'products_services', 'industry', 'lastpayment', 'compweb', 'website', 'position', 'facebook', 'twitter',
        'linkedin', 'instagram', 'speaker_presenter', 'companyAdmin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function events()
    {
        return $this->belongsToMany(Events::class);
    }

    public function timeline()
    {
        return $this->hasMany(Timeline::class);
    }

    public function followers()
    {
        return $this->hasMany(Follow::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
