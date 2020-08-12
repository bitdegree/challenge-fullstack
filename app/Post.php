<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Post
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property int $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $child
 * @property-read int|null $child_count
 * @property-read \App\Post $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $children
 * @property-read int|null $children_count
 * @property-read \App\User $user
 */
class Post extends Model
{

    public function getCreatedAtAttribute($created_at){
        return Carbon::parse($created_at)->format('g:i A');
    }

    public function getDepth($i = 0)
    {
        $i++;
        if(!$this->children->first() || $i > 100){
            return $i;
        }
        return $this->children->first()->getDepth($i);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(Post::class,'parent_id')->limit(2);
    }

    public function parent()
    {
      return $this->belongsTo(Post::class,'id', 'parent_id');
    }
}
