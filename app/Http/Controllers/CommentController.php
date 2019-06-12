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
        $comments = Comment::where('parent_id', null)
            ->orderBy('createdAt', 'asc')
            ->take(10);

        return response()->json(
            $comments
        );
    }

    public function post(Request $request) {
        $user = Auth::guard('jwt')->user();
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
