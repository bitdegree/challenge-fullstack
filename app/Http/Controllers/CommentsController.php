<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentStoreRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function index($routename)
    {
        $comments = Comment::where(['route_name' => $routename])->with(['user'])->orderBy('id', 'desc')->get();
        return response(['comments' => $comments]);
    }

    public function store(CommentStoreRequest $request)
    {
        Auth::user()->comments()->create([
            'textField' => $request->textField,
            'route_name' => $request->routeName,
        ]);
        return response([], 200);
    }
}
