<?php

namespace App\Policies;

use App\Post;
use App\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Log;
use Response;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create()
    {
        return !Auth::guest() ? true : Response::deny('You need to be logged in to write a post');
    }

    public function destroy(User $user, Post $post)
    {
        if(!Auth::guest()){
            Log::info(Auth::user()->id);
            return true;
        } else {
            return $user;
        }

    }
}
