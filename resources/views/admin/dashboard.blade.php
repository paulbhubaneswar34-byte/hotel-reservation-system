@extends('layouts.app')

@section('content')

@php

    $totalRooms =
        \App\Models\Room::count();

    $availableRooms =
        \App\Models\Room::where(
            'is_available',
            true
        )->count();

    $occupiedRooms =
        $totalRooms - $availableRooms;

    $occupancyRate =
        $totalRooms > 0
            ? round(
                ($occupiedRooms / $totalRooms) * 100
            )
            : 0;

    $totalReservations =
        \App\Models\Reservation::count();

    $pendingReservations =
        \App\Models\Reservation::where(
            'status',
            'pending'
        )->count();

    $approvedReservations =
        \App\Models\Reservation::where(
            'status',
            'approved'
        )->count();

    $rejectedReservations =
        \App\Models\Reservation::where(
            'status',
            'rejected'
        )->count();

@endphp

<div class="py-6">

    <!-- PAGE HEADER -->
    <div
        class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4 mb-8"
    >

        <div>

            <h1
                class="text-2xl sm:text-3xl font-bold text-gray-800"
            >

                Hotel Admin Dashboard

            </h1>

            <p
                class="text-gray-500 mt-1"
            >

                Monitor reservations, rooms and hotel operations

            </p>

        </div>

        <!-- ADMIN INFO -->
        <div
            class="bg-blue-600 text-white px-5 py-3 rounded-2xl shadow"
        >

            Logged in as:
            <span class="font-bold">

                {{ auth()->user()->name }}

            </span>

        </div>

    </div>

    <!-- ALERT -->
    @if($pendingReservations > 0)

        <div
            class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-5 py-4 rounded-2xl mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3"
        >

            <div>

                <strong>

                    {{ $pendingReservations }}

                </strong>

                reservation(s) waiting for approval.

            </div>

            <a
                href="/admin/reservations"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl text-center"
            >

                Review Reservations

            </a>

        </div>

    @endif

    <!-- STATS -->
    <div
        class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8"
    >

        <!-- TOTAL ROOMS -->
        <div
            class="bg-white rounded-2xl shadow p-6"
        >

            <div
                class="flex items-center justify-between mb-4"
            >

                <h2 class="text-gray-500">

                    Total Rooms

                </h2>

                <span class="text-3xl">

                    🏨

                </span>

            </div>

            <h3
                class="text-4xl font-bold text-blue-600"
            >

                {{ $totalRooms }}

            </h3>

        </div>

        <!-- TOTAL RESERVATIONS -->
        <div
            class="bg-white rounded-2xl shadow p-6"
        >

            <div
                class="flex items-center justify-between mb-4"
            >

                <h2 class="text-gray-500">

                    Reservations

                </h2>

                <span class="text-3xl">

                    📅

                </span>

            </div>

            <h3
                class="text-4xl font-bold text-green-600"
            >

                {{ $totalReservations }}

            </h3>

        </div>

        <!-- OCCUPANCY -->
        <div
            class="bg-white rounded-2xl shadow p-6"
        >

            <div
                class="flex items-center justify-between mb-4"
            >

                <h2 class="text-gray-500">

                    Occupancy Rate

                </h2>

                <span class="text-3xl">

                    📊

                </span>

            </div>

            <h3
                class="text-4xl font-bold text-purple-600"
            >

                {{ $occupancyRate }}%

            </h3>

        </div>

        <!-- PENDING -->
        <div
            class="bg-white rounded-2xl shadow p-6"
        >

            <div
                class="flex items-center justify-between mb-4"
            >

                <h2 class="text-gray-500">

                    Pending

                </h2>

                <span class="text-3xl">

                    ⏳

                </span>

            </div>

            <h3
                class="text-4xl font-bold text-yellow-500"
            >

                {{ $pendingReservations }}

            </h3>

        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div
        class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8"
    >

        <a
            href="/admin/room-types"
            class="bg-white rounded-2xl shadow p-6 hover:shadow-xl transition"
        >

            <h2
                class="text-xl font-bold text-gray-800 mb-3"
            >

                Manage Room Types

            </h2>

            <p class="text-gray-500">

                Add or edit hotel room categories

            </p>

        </a>

        <a
            href="/admin/rooms"
            class="bg-white rounded-2xl shadow p-6 hover:shadow-xl transition"
        >

            <h2
                class="text-xl font-bold text-gray-800 mb-3"
            >

                Manage Rooms

            </h2>

            <p class="text-gray-500">

                Update room availability and details

            </p>

        </a>

        <a
            href="/admin/reservations"
            class="bg-white rounded-2xl shadow p-6 hover:shadow-xl transition"
        >

            <h2
                class="text-xl font-bold text-gray-800 mb-3"
            >

                Reservation Approval

            </h2>

            <p class="text-gray-500">

                Approve or reject bookings

            </p>

        </a>

        <a
            href="/calendar"
            class="bg-white rounded-2xl shadow p-6 hover:shadow-xl transition"
        >

            <h2
                class="text-xl font-bold text-gray-800 mb-3"
            >

                Reservation Calendar

            </h2>

            <p class="text-gray-500">

                Visualize room reservations

            </p>

        </a>

    </div>

    <!-- MAIN GRID -->
    <div
        class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8"
    >

        <!-- RECENT RESERVATIONS -->
        <div
            class="xl:col-span-2 bg-white rounded-2xl shadow overflow-hidden"
        >

            <div
                class="px-6 py-4 border-b flex items-center justify-between"
            >

                <h2
                    class="text-xl font-bold text-gray-800"
                >

                    Latest Reservations

                </h2>

                <a
                    href="/admin/reservations"
                    class="text-blue-600 hover:underline"
                >

                    View All

                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-6 py-3 text-left">

                                Guest

                            </th>

                            <th class="px-6 py-3 text-left">

                                Room

                            </th>

                            <th class="px-6 py-3 text-left">

                                Status

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            \App\Models\Reservation::latest()
                            ->take(10)
                            ->get()
                            as $reservation
                        )

                            <tr class="border-b">

                                <td class="px-6 py-4">

                                    {{ $reservation->user->name }}

                                </td>

                                <td class="px-6 py-4">

                                    Room
                                    {{ $reservation->room->room_number }}

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
                                    colspan="3"
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

        <!-- STATUS SUMMARY -->
        <div
            class="bg-white rounded-2xl shadow p-6"
        >

            <h2
                class="text-xl font-bold text-gray-800 mb-6"
            >

                Reservation Summary

            </h2>

            <div class="space-y-5">

                <!-- APPROVED -->
                <div>

                    <div
                        class="flex justify-between mb-2"
                    >

                        <span class="text-gray-600">

                            Approved

                        </span>

                        <span class="font-bold">

                            {{ $approvedReservations }}

                        </span>

                    </div>

                    <div
                        class="w-full bg-gray-200 rounded-full h-3"
                    >

                        <div
                            class="bg-green-500 h-3 rounded-full"
                            style="
                                width:
                                {{
                                    $totalReservations > 0
                                    ? ($approvedReservations / $totalReservations) * 100
                                    : 0
                                }}%;
                            "
                        ></div>

                    </div>

                </div>

                <!-- PENDING -->
                <div>

                    <div
                        class="flex justify-between mb-2"
                    >

                        <span class="text-gray-600">

                            Pending

                        </span>

                        <span class="font-bold">

                            {{ $pendingReservations }}

                        </span>

                    </div>

                    <div
                        class="w-full bg-gray-200 rounded-full h-3"
                    >

                        <div
                            class="bg-yellow-500 h-3 rounded-full"
                            style="
                                width:
                                {{
                                    $totalReservations > 0
                                    ? ($pendingReservations / $totalReservations) * 100
                                    : 0
                                }}%;
                            "
                        ></div>

                    </div>

                </div>

                <!-- REJECTED -->
                <div>

                    <div
                        class="flex justify-between mb-2"
                    >

                        <span class="text-gray-600">

                            Rejected

                        </span>

                        <span class="font-bold">

                            {{ $rejectedReservations }}

                        </span>

                    </div>

                    <div
                        class="w-full bg-gray-200 rounded-full h-3"
                    >

                        <div
                            class="bg-red-500 h-3 rounded-full"
                            style="
                                width:
                                {{
                                    $totalReservations > 0
                                    ? ($rejectedReservations / $totalReservations) * 100
                                    : 0
                                }}%;
                            "
                        ></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection