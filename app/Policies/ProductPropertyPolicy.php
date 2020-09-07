<?php

namespace App\Policies;

use App\User;
use App\ProductProperty;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPropertyPolicy
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
            return true;
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
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProductProperty  $productProperty
     * @return bool
     */
    public function view(?User $user, ProductProperty $productProperty)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine if the given model can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\ProductProperty  $productProperty
     * @return bool
     */
    public function update(User $user, ProductProperty $productProperty)
    {
        return false;
    }

    /**
     * Determine if the given model can be deleted by the user.
     *
     * @param  \App\User  $user
     * @param  \App\ProductProperty  $productProperty
     * @return bool
     */
    public function delete(User $user, ProductProperty $productProperty)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProductProperty  $productProperty
     * @return mixed
     */
    public function restore(User $user, ProductProperty $productProperty)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProductProperty  $productProperty
     * @return mixed
     */
    public function forceDelete(User $user, ProductProperty $productProperty)
    {
        return false;
    }
}
