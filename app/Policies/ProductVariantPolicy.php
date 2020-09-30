<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use App\Models\ProductVariant;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductVariantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine when the user can perform any action.
     *
     * @param  \App\Models\User  $user
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
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductVariant  $productVariant
     * @return bool
     */
    public function view(?User $user, ProductVariant $productVariant)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine if the given model can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductVariant  $productVariant
     * @return bool
     */
    public function update(User $user, ProductVariant $productVariant)
    {
        return false;
    }

    /**
     * Determine if the given model can be deleted by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductVariant  $productVariant
     * @return bool
     */
    public function delete(User $user, ProductVariant $productVariant)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductVariant  $productVariant
     * @return mixed
     */
    public function restore(User $user, ProductVariant $productVariant)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductVariant  $productVariant
     * @return mixed
     */
    public function forceDelete(User $user, ProductVariant $productVariant)
    {
        return false;
    }
}
