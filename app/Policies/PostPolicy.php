<?php

namespace App\Policies;

use App\Post;
use App\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

  /**
   * Determine whether the user can create posts.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    return $user->id > 0;
  }

  /**
   * Determine whether the user can delete the post.
   *
   * @param  \App\User  $user
   * @param  \App\Post  $post
   * @return mixed
   */
  public function destroy(User $user, Post $post)
  {
    return $user->id == $post->user_id;
  }
}
