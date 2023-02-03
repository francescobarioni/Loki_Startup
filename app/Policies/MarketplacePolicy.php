<?php

namespace App\Policies;

use App\Models\Marketplace;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MarketplacePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param  \App\Models\Marketplace  $marketplace
     * @return Response|bool
     */
    public function view(User $user, Marketplace $marketplace)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        // Only admin
        return $user->role == User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param  \App\Models\Marketplace  $marketplace
     * @return Response|bool
     */
    public function update(User $user, Marketplace $marketplace)
    {
        // Only admin
        return $user->role == User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param  \App\Models\Marketplace  $marketplace
     * @return Response|bool
     */
    public function delete(User $user, Marketplace $marketplace)
    {
        // Only admin
        return $user->role == User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param  \App\Models\Marketplace  $marketplace
     * @return Response|bool
     */
    public function restore(User $user, Marketplace $marketplace)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param  \App\Models\Marketplace  $marketplace
     * @return Response|bool
     */
    public function forceDelete(User $user, Marketplace $marketplace)
    {
        //
    }
}
