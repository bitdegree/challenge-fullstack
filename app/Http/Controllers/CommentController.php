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
                'id' => $comment->id,
                'user_name' => $comment->user->name,
                'description' => $comment->description,
                'created_at' => date('D h:i A', strtotime($comment->created_at)),
                'user_photo' => $comment->user->getPhotoUrlAttribute(),
                'current_user' => $comment->user == auth()->user()
            ]);
        }
        return response($result,201);
    }

    public function add_comment(Request $request)
    {
        $fields = $request->validate([
            'comment' => 'required|string',
        ]);

        $commment = Comment::create([
            'user_id' => auth()->user()->id,
            'description' => $fields['comment'],
        ]);

        return response($commment, 201);

    }

    public function delete($id)
    {
        return Comment::find($id)->delete();
    }
}
