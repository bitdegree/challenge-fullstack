<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\ReplyStoreRequest;
use App\Reply;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    /**
     * @param int $commentId
     * @return Response
     */
    public function index(int $commentId): Response
    {
        $replies = Reply::where('comment_id', $commentId)->with('user')->orderBy('id', 'desc')->get();
        return response(['replies' => $replies], 200);
    }

    /**
     * @param ReplyStoreRequest $request
     * @return Response
     */
    public function store(ReplyStoreRequest $request): Response
    {
        Comment::findOrFail($request->id)->replies()->create([
            'textField' => $request->textField,
            'user_id' => Auth::user()->id,
        ]);
        return response([], 200);
    }
}
