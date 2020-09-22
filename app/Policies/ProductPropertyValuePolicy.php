<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use App\Models\ProductPropertyValue;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPropertyValuePolicy
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
        if (optional($user)->userable_type  === Admin::class) {
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
     * @param  \App\ProductPropertyValue  $productPropertyValue
     * @return bool
     */
    public function view(?User $user, ProductPropertyValue $productPropertyValue)
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
     * @param  \App\ProductPropertyValue  $productPropertyValue
     * @return bool
     */
    public function update(User $user, ProductPropertyValue $productPropertyValue)
    {
        return false;
    }

    /**
     * Determine if the given model can be deleted by the user.
     *
     * @param  \App\User  $user
     * @param  \App\ProductPropertyValue  $productPropertyValue
     * @return bool
     */
    public function delete(User $user, ProductPropertyValue $productPropertyValue)
    {
        return false;
    }
}
