<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * App\Timeline
 *
 * @property int $id
 * @property int $user_id
 * @property string $post_content
 * @property string|null $image_url
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comments[] $comments
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\User $owner
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Timeline onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Timeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Timeline whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Timeline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Timeline whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Timeline wherePostContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Timeline whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Timeline whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Timeline withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Timeline withoutTrashed()
 * @mixin \Eloquent
 */
class Timeline extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_creator', 'post_content', 'post_date', 'user_id', 'image_url',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
