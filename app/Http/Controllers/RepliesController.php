<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function index($commentId)
    {
//        $replies = Reply::where([
//            'comment_id' => $commentId
//        ])->with('user')->get();
        $replies = Reply::where('comment_id', $commentId)->with('user')->get();
        return response(['replies' => $replies]);
    }
}
