<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment'];

    protected $appends = ['user', 'replies'];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function replies()
    {
        $this->hasMany(Reply::class);
    }
}
