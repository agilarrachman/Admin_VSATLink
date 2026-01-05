<?php

namespace App\Policies;

use App\Models\OrderStatusHistory;
use App\Models\Sales;
use Illuminate\Auth\Access\Response;

class OrderStatusHistoryPolicy
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
    public function view(Sales $sales, OrderStatusHistory $orderStatusHistory): bool
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
    public function update(Sales $sales, OrderStatusHistory $orderStatusHistory): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Sales $sales, OrderStatusHistory $orderStatusHistory): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Sales $sales, OrderStatusHistory $orderStatusHistory): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Sales $sales, OrderStatusHistory $orderStatusHistory): bool
    {
        return false;
    }
}
