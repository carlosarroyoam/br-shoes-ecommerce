<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\CustomerShippingAddress;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerShippingAddressPolicy
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
            return false;
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
     * Determine if the given model can be viewed by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Models\CustomerShippingAddress  $customerShippingAddress
     * @return bool
     */
    public function view(User $user, customerShippingAddress $customerShippingAddress)
    {
        return $user->userable_type === Customer::class && $user->userable->id === $customerShippingAddress->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine if the given model can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Models\CustomerShippingAddress  $customerShippingAddress
     * @return bool
     */
    public function update(User $user, customerShippingAddress $customerShippingAddress)
    {
        return $user->userable_type === Customer::class && $user->userable->id === $customerShippingAddress->user_id;
    }

    /**
     * Determine if the given model can be deleted by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Models\CustomerShippingAddress  $customerShippingAddress
     * @return bool
     */
    public function delete(User $user, customerShippingAddress $customerShippingAddress)
    {
        return $user->userable_type === Customer::class && $user->userable->id === $customerShippingAddress->user_id;
    }
}
