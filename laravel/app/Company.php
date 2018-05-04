<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait as Searchable;

/**
 * App\Company
 *
 * @property int $id
 * @property string $company_name
 * @property string|null $region
 * @property string $company_address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $phone
 * @property string|null $fax
 * @property string|null $consumer
 * @property string|null $contract
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Company onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereCompanyAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereConsumer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereContract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Company withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $company_level
 * @property string|null $country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereCompanyLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereCountry($value)
 */
class Company extends Model
{
    //
    use Notifiable;
    use SoftDeletes;
    use Searchable;

    //searchable trait stuff
    protected $searchable = [
        'columns' => [
            'company.name' => 1,
            'company.email'   => 3,
            'company.rep' => 2,
            'company.address' => 4,
            'company.zip' => 3,
            'company.city' => 3,
            'company.state' => 3,
            'company.phone' => 4,
        ],
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'company_level', 'company_address', 'country', 'city', 'state', 'zip', 'phone', 'fax', 'consumer', 'contract', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
