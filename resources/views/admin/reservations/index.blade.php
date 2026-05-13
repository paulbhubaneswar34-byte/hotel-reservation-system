@extends('layouts.app')

@section('content')

<div class="py-6">

    <!-- HEADER -->
    <div class="mb-6">

        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">

            Reservations

        </h1>

        <p class="text-gray-500 mt-1">

            Manage and approve booking requests

        </p>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left">Guest</th>

                        <th class="px-6 py-4 text-left">Room</th>

                        <th class="px-6 py-4 text-left">Check In</th>

                        <th class="px-6 py-4 text-left">Check Out</th>

                        <th class="px-6 py-4 text-left">Status</th>

                        <th class="px-6 py-4 text-center">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($reservations as $reservation)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">

                                {{ $reservation->user->name }}

                            </td>

                            <td class="px-6 py-4">

                                Room {{ $reservation->room->room_number }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $reservation->check_in_date }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $reservation->check_out_date }}

                            </td>

                            <td class="px-6 py-4">

                                @if($reservation->status == 'approved')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                        Approved

                                    </span>

                                @elseif($reservation->status == 'pending')

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                        Pending

                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                        Rejected

                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex gap-2 justify-center">

                                    <!-- APPROVE -->
                                    <form
                                        method="POST"
                                        action="{{ route('admin.reservations.status', $reservation) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="status" value="approved">

                                        <button class="bg-green-500 hover:bg-green-600 cursor-pointer text-white px-3 py-2 rounded-lg">

                                            Approve

                                        </button>

                                    </form>

                                    <!-- REJECT -->
                                    <form
                                        method="POST"
                                        action="{{ route('admin.reservations.status', $reservation) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="status" value="rejected">

                                        <button class="bg-red-500 hover:bg-red-600 cursor-pointer text-white px-3 py-2 rounded-lg">

                                            Reject

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-10 text-gray-500">

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