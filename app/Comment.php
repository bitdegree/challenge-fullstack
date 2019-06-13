<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content', 'author_id', 'parent_id', 'created_at', 'updated_at'
    ];
}
