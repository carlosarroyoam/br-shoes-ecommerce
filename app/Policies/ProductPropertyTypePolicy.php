<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductPropertyType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPropertyTypePolicy
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
        if (optional($user)->userable_type  == 'App\Models\Admin') {
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
     * @param  \App\Models\ProductPropertyType  $productPropertyType
     * @return bool
     */
    public function view(?User $user, ProductPropertyType $productPropertyType)
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
     * @param  \App\Models\ProductPropertyType  $productPropertyType
     * @return bool
     */
    public function update(User $user, ProductPropertyType $productPropertyType)
    {
        return false;
    }

    /**
     * Determine if the given model can be deleted by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductPropertyType  $productPropertyType
     * @return bool
     */
    public function delete(User $user, ProductPropertyType $productPropertyType)
    {
        return false;
    }
}
