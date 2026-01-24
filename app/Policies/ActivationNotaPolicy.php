<?php

namespace App\Policies;

use App\Models\ActivationNota;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class ActivationNotaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, ActivationNota $activationNota): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, ActivationNota $activationNota): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, ActivationNota $activationNota): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, ActivationNota $activationNota): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, ActivationNota $activationNota): bool
    {
        return false;
    }
}
