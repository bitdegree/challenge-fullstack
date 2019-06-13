<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('post');
    }

    public function index() {
        $comments = Comment::whereNull('parent_id')
            ->join('users', 'comments.author_id', '=', 'users.id')
            ->select('comments.*', 'users.firstName', 'users.lastName', 'users.avatarURL')
            ->orderBy('comments.created_at', 'asc')
            ->get();

        return response()->json(
            $comments
        );
    }

    public function store(Request $request) {
        $user = Auth::guard('api')->user();
        $parent = $request->get('parent', null);
        $content = $request->get('content', null);

        if($content === null)
            return response()->json(
                [
                    "message" => "Content is empty!"
                ],
                400
            );

        $comment = Comment::create(
            [
                'author_id' => $user->id,
                'parent_id' => $parent,
                'content' => $content
            ]
        );

        return response()->json(
            $comment
        );
    }

}
