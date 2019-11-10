<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["textField", "route_name"];

    protected $casts = [
        'updated_at' => 'datetime: h:i A',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
