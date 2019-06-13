<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store');
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

    public function viewReplies($id) {
        $comment = Comment::find($id);

        if($comment === null)
            return response()->json(
                [
                    "message" => 'id was invalid!'
                ],
                400
            );

        $user = User::find($comment->author_id);
        $comment->firstName = $user->firstName;
        $comment->lastName = $user->lastName;
        $comment->avatarURL = $user->avatarURL;

        $comments = Comment::where('parent_id', $id)
            ->join('users', 'comments.author_id', '=', 'users.id')
            ->select('comments.*', 'users.firstName', 'users.lastName', 'users.avatarURL')
            ->orderBy('comments.created_at', 'asc')
            ->get();

        return response()->json(
            array_merge(
                [$comment],
                $comments->toArray()
            )
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

        if($parent !== null) {
            $parentComment = Comment::find(
                $parent
            );

            if($parentComment === null)
                return response()->json(
                    [
                        "message" => "Parent comment id is invalid!"
                    ],
                    400
                );

            if($parentComment->parent_id !== null)
                return response()->json(
                    [
                        "message" => "Only to levels of replies are supported!"
                    ],
                    400
                );

            $parentComment->num_replies++;
            $parentComment->save();
        }

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
