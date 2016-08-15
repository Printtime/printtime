<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{

    use HandlesAuthorization;

    /**
     * @param User   $user
     * @param string $ability
     *
     * @return bool
     */
    public function before(User $user, $ability, User $item)
    {
        if ($user->isSuperAdmin()) {
            if ($ability != 'display' && $ability != 'create' && $item->id <= 1) {
                return false;
            }

            return true;
        }
    }

    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function display(User $user, User $item)
    {
        #return true;
        if ($user->isSuperAdmin() OR $user->isManager()) {
            return true;
        }
        #return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function edit(User $user, User $item)
    {

        return $item->id > 1;
    }

    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function delete(User $user, User $item)
    {

        return $item->id > 1;
    }
}
