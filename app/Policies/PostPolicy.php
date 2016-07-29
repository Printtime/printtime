<?php

namespace App\Policies;

use App\Model\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{

    use HandlesAuthorization;

    public function before(User $user, $ability, Post $item)
    {
        if ($user->isManager()) {
            return true;
        }
    }

}