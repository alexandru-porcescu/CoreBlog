<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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

    public function update(User $currentUser, Post $post)
    {
        return $currentUser->id === $post->user_id;
    }

    public function show(User $currentUser, Post $post)
    {
        if ($post->status != 1) {
            if ($currentUser->id == 1 || $currentUser->id === $post->user_id) {
                return true;
            }
            return false;
        }
        return true;
    }
}
