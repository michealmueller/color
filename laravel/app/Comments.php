<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * App\Comments
 *
 * @property int $id
 * @property int $timeline_id
 * @property int $user_id
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Timeline $owner
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Comments onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereTimelineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comments withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Comments withoutTrashed()
 * @mixin \Eloquent
 */
class Comments extends Model
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
        'timeline_id', 'user_id', 'content',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function owner()
    {
        return $this->belongsTo(Timeline::class);
    }

}
