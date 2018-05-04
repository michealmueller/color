<?php

namespace App;

use Corcel\Post as Corcel;

/**
 * App\Event
 *
 * @property int $ID
 * @property int $post_author
 * @property \Carbon\Carbon $post_date
 * @property \Carbon\Carbon $post_date_gmt
 * @property string $post_content
 * @property string $post_title
 * @property string $post_excerpt
 * @property string $post_status
 * @property string $comment_status
 * @property string $ping_status
 * @property string $post_password
 * @property string $post_name
 * @property string $to_ping
 * @property string $pinged
 * @property \Carbon\Carbon $post_modified
 * @property \Carbon\Carbon $post_modified_gmt
 * @property string $post_content_filtered
 * @property int $post_parent
 * @property string $guid
 * @property int $menu_order
 * @property string $post_type
 * @property string $post_mime_type
 * @property int $comment_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Corcel\Post[] $attachment
 * @property-read \Corcel\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\Corcel\Comment[] $comments
 * @property-read \AdvancedCustomFields $acf
 * @property-read int $author_id
 * @property-read string $content
 * @property-read \date $created_at
 * @property-read string $excerpt
 * @property-read string $image
 * @property-read array $keywords
 * @property-read string $keywords_str
 * @property-read string $main_category
 * @property-read string $mime_type
 * @property-read int $parent_id
 * @property-read string $slug
 * @property-read string $status
 * @property-read array $terms
 * @property-read string $title
 * @property-read string $type
 * @property-read \date $updated_at
 * @property-read string $url
 * @property-read \Corcel\PostMetaCollection|\Corcel\PostMeta[] $meta
 * @property-read \Corcel\Post $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Corcel\Post[] $revision
 * @property-read \Illuminate\Database\Eloquent\Collection|\Corcel\TermTaxonomy[] $taxonomies
 * @property-read \Corcel\ThumbnailMeta $thumbnail
 * @method static \Illuminate\Database\Eloquent\Builder|\Corcel\Post hasMeta($meta, $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereCommentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereCommentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereGuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereMenuOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePingStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePinged($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostContentFiltered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostDateGmt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostModifiedGmt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event whereToPing($value)
 * @mixin \Eloquent
 */
class Event extends Corcel
{
    protected $connection = 'wordpress';
}

