<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Events
 *
 * @property int $id
 * @property int|null $event_id
 * @property int|null $user_id
 * @property int $amount_paid
 * @property string $attendee_type
 * @property string $payment_date
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Events onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Events whereAmountPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Events whereAttendeeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Events whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Events whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Events whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Events whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Events wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Events whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Events whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Events withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Events withoutTrashed()
 * @mixin \Eloquent
 */
class Events extends Model
{

    use SoftDeletes;
    //

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'event_id', 'attendee_type', 'amount_paid', 'payment_date'
    ];


    public function getUsers()
    {
        return $this->belongsToMany(User::class);
    }
}
