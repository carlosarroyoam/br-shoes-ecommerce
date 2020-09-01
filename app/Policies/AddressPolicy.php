<?php

namespace App\Policies;

use App\User;
use App\Address;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine when the user can perform any action.
     *
     * @param  \App\User  $user
     * @param  $ability
     * @return bool
     */
    public function before(?User $user, $ability)
    {
        if (optional($user)->is_admin) {
            return false;
        }
    }

    /**
     * Determine whether the user can view any model.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine if the given model can be viewed by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Address  $address
     * @return bool
     */
    public function view(User $user, Address $address)
    {
        return $user->id === $address->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine if the given model can be updated by the user.
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
     * Determine if the given model can be deleted by the user.
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
