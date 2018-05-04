<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait as Searchable;

/**
 * App\MemberFiles
 *
 * @property int $id
 * @property string $filename
 * @property string $file_location
 * @property string $file_type
 * @property string $category
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\MemberFiles onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberFiles whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberFiles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberFiles whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberFiles whereFileLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberFiles whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberFiles whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberFiles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MemberFiles whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MemberFiles withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\MemberFiles withoutTrashed()
 * @mixin \Eloquent
 */
class MemberFiles extends Model
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
        'filename', 'file_location', 'file_type', 'category',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
