<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{

    public function show_all()
    {
        $result = [];
        foreach (Comment::all() as $comment){
            array_push($result,[
                'user_name' => $comment->user->name,
                'description' => $comment->description,
                'created_at' => date('h:i A', strtotime($comment->created_at)),
                'user_photo' => $comment->user->getPhotoUrlAttribute()
            ]);
        }
        return response($result,201);
    }
}
