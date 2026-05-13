@extends('layouts.app')

@section('content')

<div class="py-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">

                Rooms

            </h1>

            <p class="text-gray-500 mt-1">

                Manage hotel rooms and availability

            </p>

        </div>

        <a
            href="{{ route('admin.rooms.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow text-center"
        >

            Add Room

        </a>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left">Room No</th>

                        <th class="px-6 py-4 text-left">Type</th>

                        <th class="px-6 py-4 text-left">Price</th>

                        <th class="px-6 py-4 text-left">Status</th>

                        <th class="px-6 py-4 text-center">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($rooms as $room)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4 font-semibold">

                                {{ $room->room_number }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $room->roomType->name }}

                            </td>

                            <td class="px-6 py-4 text-green-600 font-bold">

                                ₹{{ $room->roomType->price_per_night ?? 'N/A' }}

                            </td>

                            <td class="px-6 py-4">

                                @if($room->is_available)

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                        Available

                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                        Unavailable

                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex gap-2 justify-center">

    <!-- EDIT -->
    <a
        href="{{ route('admin.rooms.edit', $room) }}"
        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg"
    >
        Edit
    </a>

    <!-- DELETE -->
    <form
        method="POST"
        action="{{ route('admin.rooms.destroy', $room) }}"
        onsubmit="return confirm('Delete this room?')"
    >
        @csrf
        @method('DELETE')

        <button class="bg-red-500 hover:bg-red-600 cursor-pointer text-white px-3 py-2 rounded-lg">
            Delete
        </button>

    </form>

</div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-10 text-gray-500">

                                No rooms found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection