<?php

namespace App\Policies;

use App\Models\Joueur;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JoueurPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Joueur $joueur): bool
    {
        if ($user->role && $user->role->nom === 'admin') {
            return true;
        }

        if ($user->role && $user->role->nom === 'user') {
            return $joueur->user_id === $user->id;
        }

        if ($user->role && $user->role->nom === 'coach') {
            return $joueur->user_id === $user->id || ($joueur->user && $joueur->user->role->name === 'user');
        }

        return false;
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Joueur $joueur): bool
    {
        if ($user->role && $user->role->nom === 'admin') {
            return true;
        }
        if ($user->role === 'user' || $user->role === 'coach') {
            return $joueur->user_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Joueur $joueur): bool
    {
        if ($user->role && $user->role->nom === 'admin') {
            return true;
        }

        if ($user->role && $user->role->nom === 'user') {
            return $joueur->user_id === $user->id;
        }

        if ($user->role && $user->role->nom === 'coach') {
            return $joueur->user_id === $user->id || ($joueur->user && $joueur->user->role->nom === 'user');
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Joueur $joueur): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Joueur $joueur): bool
    {
        return false;
    }
}
