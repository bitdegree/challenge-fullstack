<?php

namespace App\Http\Controllers;

class CommentController extends Controller
{

    /**
     * Show the controller task.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('comment');
    }

}
