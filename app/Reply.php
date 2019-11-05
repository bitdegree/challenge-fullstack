<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['reply'];

    protected $appends = ['comment'];

    public function comment()
    {
        $this->belongsTo(Comment::class);
    }
}
