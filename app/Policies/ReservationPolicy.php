<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reservation;

class ReservationPolicy
{
    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        User $user,
        Reservation $reservation
    ): bool {

        return $user->id === $reservation->user_id;
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete(
        User $user,
        Reservation $reservation
    ): bool {

        return $user->id === $reservation->user_id;
    }
}