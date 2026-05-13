<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReservationController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $reservations = Reservation::with('room')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view(
            'reservations.index',
            compact('reservations')
        );
    }

    public function create(Request $request)
{
    $rooms = Room::where(
        'is_available',
        true
    )->get();

    $selectedRoom = $request->room_id;

    return view(
        'reservations.create',
        compact('rooms', 'selectedRoom')
    );
}

    public function store(ReservationRequest $request)
    {
        $room = Room::findOrFail($request->room_id);

        $checkIn = $request->check_in_date;

        $checkOut = $request->check_out_date;

        $conflict = Reservation::where('room_id', $room->id)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($checkIn, $checkOut) {

                $query->whereBetween(
                    'check_in_date',
                    [$checkIn, $checkOut]
                )
                ->orWhereBetween(
                    'check_out_date',
                    [$checkIn, $checkOut]
                );
            })
            ->exists();

        if ($conflict) {

            return back()->withErrors([
                'room_id' => 'Room unavailable for selected dates.'
            ]);
        }

        $days = Carbon::parse($checkIn)
            ->diffInDays(Carbon::parse($checkOut));

        $totalPrice =
            $days * $room->roomType->price_per_night;

            if ($checkIn >= $checkOut) {

    return back()->withErrors([
        'error' => 'Invalid reservation dates.'
    ]);
}

        Reservation::create([
            'user_id' => auth()->id(),
            'room_id' => $room->id,
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'status' => 'pending',
            'total_price' => $totalPrice,
        ]);

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reservation Created');
    }

    public function edit(Reservation $reservation)
    {
        $this->authorize('update', $reservation);

        $rooms = Room::all();

        return view(
            'reservations.edit',
            compact('reservation', 'rooms')
        );
    }

    public function update(
        ReservationRequest $request,
        Reservation $reservation
    ) {
        $this->authorize('update', $reservation);

        if (
            Carbon::parse($reservation->check_in_date)
                ->diffInHours(now()) < 24
        ) {

            return back()->withErrors([
                'error' => 'Cannot modify within 24 hours.'
            ]);
        }

        $reservation->update([
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
        ]);

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reservation Updated');
    }

    public function destroy(
    Reservation $reservation
)
{
    $this->authorize(
        'delete',
        $reservation
    );

    /*
    |--------------------------------------------------------------------------
    | ROOM AVAILABLE AGAIN
    |--------------------------------------------------------------------------
    */

    $reservation->room->update([

        'is_available' => true

    ]);

    /*
    |--------------------------------------------------------------------------
    | DELETE RESERVATION
    |--------------------------------------------------------------------------
    */

    $reservation->delete();

    /*
    |--------------------------------------------------------------------------
    | REDIRECT
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('reservations.index')
        ->with(
            'success',
            'Reservation cancelled successfully.'
        );
}
}