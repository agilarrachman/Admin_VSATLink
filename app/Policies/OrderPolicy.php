<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\Sales;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Sales $sales): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Sales $sales, Order $order): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Sales $sales): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Sales $sales, Order $order): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Sales $sales, Order $order): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Sales $sales, Order $order): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Sales $sales, Order $order): bool
    {
        return false;
    }
}
