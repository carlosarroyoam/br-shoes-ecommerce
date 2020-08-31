<?php

namespace App\Policies;

use App\User;
use App\Address;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
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

    public function before($user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * Determine if the given address can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Address  $address
     * @return bool
     */
    public function update(User $user, Address $address)
    {
        return $user->id === $address->user_id;
    }

    /**
     * Determine if the given address can be deleted by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Address  $address
     * @return bool
     */
    public function delete(User $user, Address $address)
    {
        return $user->id === $address->user_id;
    }

}
