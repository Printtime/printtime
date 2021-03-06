<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isManager()) {
            return true;
        }
    }
}
