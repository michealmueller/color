<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * App\Adverts
 *
 * @property int $id
 * @property string $advert_name
 * @property string $advert_location
 * @property string $advert_link
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Adverts onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Adverts whereAdvertLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Adverts whereAdvertLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Adverts whereAdvertName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Adverts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Adverts whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Adverts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Adverts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Adverts withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Adverts withoutTrashed()
 * @mixin \Eloquent
 */
class Adverts extends Model
{
    //
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'advert_name', 'advert_location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
