<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationManagementController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | RESERVATION LIST
    |--------------------------------------------------------------------------
    */

    public function index()
{
    $reservations = Reservation::with([
        'user',
        'room.roomType'
    ])->latest()->get();

    return view(
        'admin.reservations.index',
        compact('reservations')
    );
}

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS
    |--------------------------------------------------------------------------
    */

    public function updateStatus(
        Request $request,
        Reservation $reservation
    )
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATE
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'status' =>
                'required|in:approved,rejected'

        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE RESERVATION STATUS
        |--------------------------------------------------------------------------
        */

        $reservation->update([

            'status' => $request->status

        ]);

        /*
        |--------------------------------------------------------------------------
        | ROOM AVAILABILITY
        |--------------------------------------------------------------------------
        */

        if ($request->status === 'approved') {

            /*
            |--------------------------------------------------------------------------
            | ROOM BECOMES UNAVAILABLE
            |--------------------------------------------------------------------------
            */

            $reservation->room->update([

                'is_available' => false

            ]);

        } else {

            /*
            |--------------------------------------------------------------------------
            | ROOM BECOMES AVAILABLE
            |--------------------------------------------------------------------------
            */

            $reservation->room->update([

                'is_available' => true

            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->back()
            ->with(
                'success',
                'Reservation status updated successfully.'
            );
    }
}