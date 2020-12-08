<?php

namespace App\Policies;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartnerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin || $user->partners()->exists();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param Partner          $partner
     * @return mixed
     */
    public function view(User $user, Partner $partner)
    {
        return $user->isAdmin || $user->partners->pluck('id')->contains($partner->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param Partner          $partner
     * @return mixed
     */
    public function update(User $user, Partner $partner)
    {
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param Partner          $partner
     * @return mixed
     */
    public function delete(User $user, Partner $partner)
    {
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param Partner          $partner
     * @return mixed
     */
    public function restore(User $user, Partner $partner)
    {
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param Partner          $partner
     * @return mixed
     */
    public function forceDelete(User $user, Partner $partner)
    {
        return $user->isAdmin;
    }
}
