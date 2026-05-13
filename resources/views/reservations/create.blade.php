@extends('layouts.app')

@section('content')

<div x-data="{ open: true }">

    <!-- Modal Background -->
    <div x-show="open"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">

        <!-- Modal Content -->
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden">

            <!-- Header -->
            <div class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center">

                <h2 class="text-2xl font-bold">

                    Book Reservation

                </h2>
<button
    @click="window.location.href='{{ route('rooms') }}'"
    class="text-white text-2xl leading-none hover:text-gray-200 cursor-pointer"
>

    &times;

</button>

            </div>

            <!-- Form Content -->
            <div class="p-6">

                <form method="POST"
                      action="{{ route('reservations.store') }}">

                    @csrf

                    <!-- Room Selection -->
                    <div class="mb-5">

                        <label class="block mb-2 font-semibold text-gray-700">

                            Select Room

                        </label>

                        <select name="room_id"
                                class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-200">

                            @foreach($rooms as $room)

                                <option value="{{ $room->id }}"
                                    {{ (isset($selectedRoom) && $selectedRoom == $room->id) ? 'selected' : '' }}>

                                    Room {{ $room->room_number }}
                                    -
                                    {{ $room->roomType->name }}
                                    -
                                    ₹{{ $room->roomType->price_per_night }}/night

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Check In -->
                    <div class="mb-5">

                        <label class="block mb-2 font-semibold text-gray-700">

                            Check In Date

                        </label>

                        <input type="date"
                               name="check_in_date"
                               min="{{ date('Y-m-d') }}"
                               class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-200">

                    </div>

                    <!-- Check Out -->
                    <div class="mb-5">

                        <label class="block mb-2 font-semibold text-gray-700">

                            Check Out Date

                        </label>

                        <input type="date"
                               name="check_out_date"
                               min="{{ date('Y-m-d') }}"
                               class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-200">

                    </div>

                    <!-- Reservation Info -->
                    <div class="bg-gray-100 rounded-lg p-4 mb-6">

                        <h3 class="font-bold text-lg mb-2">

                            Reservation Policy

                        </h3>

                        <ul class="list-disc pl-5 text-gray-700 space-y-1">

                            <li>
                                Reservations can be modified before 24 hours of check-in.
                            </li>

                            <li>
                                Cancellations are allowed before 24 hours of check-in.
                            </li>

                            <li>
                                Room availability depends on selected dates.
                            </li>

                        </ul>

                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between items-center">

                        <a href="/rooms"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-lg">

                            Back

                        </a>

                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 cursor-pointer text-white px-6 py-3 rounded-lg font-semibold">

                            Confirm Reservation

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection