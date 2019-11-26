<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentStoreRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * @param $routename
     * @return \Illuminate\Http\Response
     */
    public function index(string $routename): Response
    {
        $comments = Comment::where(['route_name' => $routename])->with(['user'])->orderBy('id', 'desc')->get();
        return response(['comments' => $comments]);
    }

    /**
     * @param CommentStoreRequest $request
     * @return Response
     */
    public function store(CommentStoreRequest $request): Response
    {
        Auth::user()->comments()->create([
            'textField' => $request->textField,
            'route_name' => $request->routeName,
        ]);
        return response([], 200);
    }
}
