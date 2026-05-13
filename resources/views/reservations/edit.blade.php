@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center py-6">

    <div
        class="w-full max-w-3xl bg-white rounded-2xl shadow-xl overflow-hidden"
    >

        <!-- HEADER -->
        <div
            class="bg-yellow-500 px-4 sm:px-6 py-4 flex items-center justify-between"
        >

            <h1
                class="text-xl sm:text-2xl font-bold text-white"
            >

                Edit Reservation

            </h1>

            <a
                href="/reservations"
                class="text-white text-2xl hover:text-gray-200"
            >

                &times;

            </a>

        </div>

        <!-- BODY -->
        <div class="p-4 sm:p-6 lg:p-8">

            <!-- ERRORS -->
            @if ($errors->any())

                <div
                    class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-6"
                >

                    <ul class="list-disc pl-5 space-y-1">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <!-- FORM -->
            <form
                method="POST"
                action="{{ route('reservations.update', $reservation->id) }}"
            >

                @csrf
                @method('PUT')

                <!-- GRID -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-5"
                >

                    <!-- ROOM -->
                    <div class="md:col-span-2">

                        <label
                            class="block mb-2 font-semibold text-gray-700"
                        >

                            Select Room

                        </label>

                        <select
                            name="room_id"
                            class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-yellow-300 focus:outline-none"
                        >

                            @foreach($rooms as $room)

                                <option
                                    value="{{ $room->id }}"
                                    {{ $reservation->room_id == $room->id ? 'selected' : '' }}
                                >

                                    Room {{ $room->room_number }}
                                    -
                                    {{ $room->roomType->name }}
                                    -
                                    ₹{{ $room->roomType->price_per_night }}/night

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- CHECK IN -->
                    <div>

                        <label
                            class="block mb-2 font-semibold text-gray-700"
                        >

                            Check In Date

                        </label>

                        <input
                            type="date"
                            name="check_in_date"
                            value="{{ $reservation->check_in_date }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-yellow-300 focus:outline-none"
                        >

                    </div>

                    <!-- CHECK OUT -->
                    <div>

                        <label
                            class="block mb-2 font-semibold text-gray-700"
                        >

                            Check Out Date

                        </label>

                        <input
                            type="date"
                            name="check_out_date"
                            value="{{ $reservation->check_out_date }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-yellow-300 focus:outline-none"
                        >

                    </div>

                    <!-- STATUS -->
                    <div class="md:col-span-2">

                        <label
                            class="block mb-2 font-semibold text-gray-700"
                        >

                            Reservation Status

                        </label>

                        <div>

                            @if($reservation->status == 'pending')

                                <span
                                    class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm"
                                >

                                    Pending

                                </span>

                            @elseif($reservation->status == 'approved')

                                <span
                                    class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm"
                                >

                                    Approved

                                </span>

                            @elseif($reservation->status == 'rejected')

                                <span
                                    class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm"
                                >

                                    Rejected

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

                <!-- POLICY -->
                <div
                    class="bg-gray-100 rounded-2xl p-4 sm:p-5 mt-6"
                >

                    <h3
                        class="text-lg font-bold text-gray-800 mb-3"
                    >

                        Reservation Modification Policy

                    </h3>

                    <ul
                        class="list-disc pl-5 text-gray-700 space-y-2 text-sm sm:text-base"
                    >

                        <li>
                            Reservation can only be updated before check-in.
                        </li>

                        <li>
                            Room availability depends on selected dates.
                        </li>

                        <li>
                            Admin approval may be required again.
                        </li>

                    </ul>

                </div>

                <!-- BUTTONS -->
                <div
                    class="flex flex-col sm:flex-row gap-3 sm:justify-between mt-8"
                >

                    <!-- BACK -->
                    <a
                        href="/reservations"
                        class="w-full sm:w-auto text-center bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition"
                    >

                        Back

                    </a>

                    <!-- UPDATE -->
                    <button
                        type="submit"
                        class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl font-semibold transition"
                    >

                        Update Reservation

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection