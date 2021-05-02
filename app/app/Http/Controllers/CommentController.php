<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index() 
    {
        $comments = Comment::all()->toArray();
        return array_reverse($comments);
    }

    public function store(Request $request)
    {
        $comment = new Comment([
            'name' => $request->input('name'),
            'comment' => $request->input('comment')
        ]);
        $comment->save();

        return response()->json('Comment saved!');
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        return response()->json($comment);
    }

    public function update($id, Request $request)
    {
        $comment = Comment::find($id);
        $comment->update($request->all());

        return response()->json('Comment updated!');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return response()->json('Comment deleted!');
    }
}
