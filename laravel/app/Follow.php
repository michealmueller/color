<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Follow
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $follower_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Follow onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereFollowerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Follow withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Follow withoutTrashed()
 * @mixin \Eloquent
 */
class Follow extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];


    //
    protected $fillable = [
        'user_id', 'follower_id',
    ];
}
