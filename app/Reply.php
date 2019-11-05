<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ["textField"];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
