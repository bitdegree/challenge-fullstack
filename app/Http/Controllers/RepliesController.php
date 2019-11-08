<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\ReplyStoreRequest;
use App\Reply;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function index($commentId)
    {
        $replies = Reply::where('comment_id', $commentId)->with('user')->orderBy('id', 'desc')->get();
        return response(['replies' => $replies]);
    }

    public function store(ReplyStoreRequest $request)
    {
        Comment::find($request->id)->replies()->create([
            'textField' => $request->textField,
            'user_id' => Auth::user()->id,
        ]);
        return response([], 200);
    }
}
