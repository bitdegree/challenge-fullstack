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
                'created' => $comment->created_at,
            ]);
        }
        return response($result,201);
    }
}
