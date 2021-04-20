<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{

    public function show_all()
    {
        return response(Comment::all(),201);
    }
}
