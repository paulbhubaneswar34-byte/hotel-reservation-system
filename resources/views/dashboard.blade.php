@extends('layouts.app')

@section('content')

<div class="py-6">

    <!-- HEADER -->
    <div
        class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8"
    >

        <div>

            <h1
                class="text-2xl sm:text-3xl font-bold text-gray-800"
            >

                Welcome,
                {{ auth()->user()->name }}

            </h1>

            <p class="text-gray-500 mt-1">

                Manage your reservations and explore rooms

            </p>

        </div>

        <a
            href="/rooms"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow"
        >

            Browse Rooms

        </a>

    </div>

    <!-- STATS -->
    <div
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8"
    >

        <!-- TOTAL BOOKINGS -->
        <div
            class="bg-white rounded-2xl shadow p-6"
        >

            <h2 class="text-gray-500 text-sm mb-2">

                Total Reservations

            </h2>

            <h3 class="text-3xl font-bold text-blue-600">

                {{ auth()->user()->reservations()->count() }}

            </h3>

        </div>

        <!-- APPROVED -->
        <div
            class="bg-white rounded-2xl shadow p-6"
        >

            <h2 class="text-gray-500 text-sm mb-2">

                Approved Reservations

            </h2>

            <h3 class="text-3xl font-bold text-green-600">

                {{
                    auth()->user()
                    ->reservations()
                    ->where('status', 'approved')
                    ->count()
                }}

            </h3>

        </div>

        <!-- PENDING -->
        <div
            class="bg-white rounded-2xl shadow p-6"
        >

            <h2 class="text-gray-500 text-sm mb-2">

                Pending Reservations

            </h2>

            <h3 class="text-3xl font-bold text-yellow-500">

                {{
                    auth()->user()
                    ->reservations()
                    ->where('status', 'pending')
                    ->count()
                }}

            </h3>

        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div
        class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8"
    >

        <!-- BOOK ROOM -->
        <div
            class="bg-white rounded-2xl shadow p-6"
        >

            <h2
                class="text-xl font-bold text-gray-800 mb-3"
            >

                Book a Room

            </h2>

            <p
                class="text-gray-500 mb-5"
            >

                Browse available rooms and reserve instantly.

            </p>

            <a
                href="/rooms"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl"
            >

                View Rooms

            </a>

        </div>

        <!-- VIEW RESERVATIONS -->
        <div
            class="bg-white rounded-2xl shadow p-6"
        >

            <h2
                class="text-xl font-bold text-gray-800 mb-3"
            >

                My Reservations

            </h2>

            <p
                class="text-gray-500 mb-5"
            >

                Check booking status or modify reservations.

            </p>

            <a
                href="/reservations"
                class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl"
            >

                View Reservations

            </a>

        </div>

    </div>

    <!-- RECENT BOOKINGS -->
    <div
        class="bg-white rounded-2xl shadow overflow-hidden"
    >

        <div
            class="px-6 py-4 border-b"
        >

            <h2
                class="text-xl font-bold text-gray-800"
            >

                Recent Reservations

            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-left">

                            Room

                        </th>

                        <th class="px-6 py-3 text-left">

                            Check In

                        </th>

                        <th class="px-6 py-3 text-left">

                            Check Out

                        </th>

                        <th class="px-6 py-3 text-left">

                            Status

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse(
                        auth()->user()
                        ->reservations()
                        ->latest()
                        ->take(5)
                        ->get()
                        as $reservation
                    )

                        <tr class="border-b">

                            <td class="px-6 py-4">

                                Room
                                {{ $reservation->room->room_number }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $reservation->check_in_date }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $reservation->check_out_date }}

                            </td>

                            <td class="px-6 py-4">

                                @if($reservation->status == 'approved')

                                    <span
                                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm"
                                    >

                                        Approved

                                    </span>

                                @elseif($reservation->status == 'pending')

                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm"
                                    >

                                        Pending

                                    </span>

                                @else

                                    <span
                                        class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm"
                                    >

                                        Rejected

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center py-8 text-gray-500"
                            >

                                No reservations found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection