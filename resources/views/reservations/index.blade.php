@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <div class="flex justify-between mb-6">

        <h1 class="text-2xl font-bold">

            My Reservations

        </h1>

        <a href="/rooms"
           class="bg-blue-600 text-white px-4 py-2 rounded">

            Book Room

        </a>

    </div>

    <table class="w-full border">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3 border">Room</th>

                <th class="p-3 border">Check In</th>

                <th class="p-3 border">Check Out</th>

                <th class="p-3 border">Status</th>

                <th class="p-3 border">Price</th>

                <th class="p-3 border">Actions</th>

            </tr>

        </thead>

        <tbody>

            @foreach($reservations as $reservation)

                <tr>

                    <td class="p-3 border">

                        {{ $reservation->room->room_number }}

                    </td>

                    <td class="p-3 border">

                        {{ $reservation->check_in_date }}

                    </td>

                    <td class="p-3 border">

                        {{ $reservation->check_out_date }}

                    </td>

                    <td class="p-3 border">

                        {{ ucfirst($reservation->status) }}

                    </td>

                    <td class="p-3 border">

                        ₹{{ $reservation->total_price }}

                    </td>

                    <td class="px-4 py-3">

    <div
        class="flex flex-col sm:flex-row gap-2"
    >

        <!-- EDIT -->
        <a
            href="{{ route('reservations.edit', $reservation->id) }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-center"
        >

            Edit

        </a>

        <!-- CANCEL -->
        <form
            action="{{ route('reservations.destroy', $reservation->id) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to cancel this reservation?')"
        >

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="w-full bg-red-500 hover:bg-red-600 cursor-pointer text-white px-4 py-2 rounded-lg"
            >

                Cancel

            </button>

        </form>

    </div>

</td>
                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="mt-6">

        {{ $reservations->links() }}

    </div>

</div>

@endsection