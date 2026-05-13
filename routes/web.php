<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ReservationController;

use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\ReservationManagementController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect('/login');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/register',
        [AuthController::class, 'showRegister']
    )->name('register');

    Route::post(
        '/register',
        [AuthController::class, 'register']
    );

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/login',
        [AuthController::class, 'showLogin']
    )->name('login');

    Route::post(
        '/login',
        [AuthController::class, 'login']
    );

});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->middleware('auth')
->name('logout');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/dashboard',
        'dashboard'
    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ROOMS PAGE
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/rooms',
        'rooms'
    )->name('rooms');

    /*
    |--------------------------------------------------------------------------
    | USER RESERVATIONS
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'reservations',
        ReservationController::class
    );

    /*
    |--------------------------------------------------------------------------
    | USER CALENDAR
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/calendar',
        'calendar'
    )->name('calendar');

    /*
    |--------------------------------------------------------------------------
    | CALENDAR EVENTS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/calendar-events',
        function () {

            /*
            |--------------------------------------------------------------------------
            | ADMIN SEES ALL
            |--------------------------------------------------------------------------
            */

            if (
                auth()->user()->role === 'admin'
            ) {

                $reservations =
                    \App\Models\Reservation::with([
                        'room',
                        'user'
                    ])->get();

            } else {

                /*
                |--------------------------------------------------------------------------
                | USER SEES OWN
                |--------------------------------------------------------------------------
                */

                $reservations =
                    \App\Models\Reservation::with([
                        'room',
                        'user'
                    ])
                    ->where(
                        'user_id',
                        auth()->id()
                    )
                    ->get();
            }

            $events = [];

            foreach (
                $reservations
                as $reservation
            ) {

                /*
                |--------------------------------------------------------------------------
                | STATUS COLORS
                |--------------------------------------------------------------------------
                */

                $color = '#22c55e';

                if (
                    $reservation->status === 'pending'
                ) {

                    $color = '#eab308';

                }

                if (
                    $reservation->status === 'rejected'
                ) {

                    $color = '#ef4444';

                }

                $events[] = [

                    'title' =>
                        'Room ' .
                        $reservation
                        ->room
                        ->room_number,

                    'start' =>
                        $reservation
                        ->check_in_date,

                    'end' =>
                        $reservation
                        ->check_out_date,

                    'backgroundColor' =>
                        $color,

                    'borderColor' =>
                        $color,

                    /*
                    |--------------------------------------------------------------------------
                    | EXTRA DETAILS
                    |--------------------------------------------------------------------------
                    */

                    'room' =>
                        'Room ' .
                        $reservation
                        ->room
                        ->room_number,

                    'guest' =>
                        $reservation
                        ->user
                        ->name,

                    'status' =>
                        ucfirst(
                            $reservation->status
                        ),

                ];
            }

            return response()->json($events);

        }
    )->name('calendar.events');

});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'admin'
])
->prefix('admin')
->name('admin.')
->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/dashboard',
        'admin.dashboard'
    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ROOM TYPES
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'room-types',
        RoomTypeController::class
    );

    /*
    |--------------------------------------------------------------------------
    | ROOMS MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'rooms',
        RoomController::class
    );

    /*
    |--------------------------------------------------------------------------
    | ADMIN RESERVATIONS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/reservations',
        [
            ReservationManagementController::class,
            'index'
        ]
    )->name('reservations.index');

    /*
    |--------------------------------------------------------------------------
    | UPDATE RESERVATION STATUS
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/reservations/{reservation}/status',
        [
            ReservationManagementController::class,
            'updateStatus'
        ]
    )->name('reservations.status');

    /*
    |--------------------------------------------------------------------------
    | ADMIN CALENDAR
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/calendar',
        'calendar'
    )->name('calendar');

});