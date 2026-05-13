<div>

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-3xl font-bold">
            Available Rooms
        </h2>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @forelse($rooms as $room)

            <div class="bg-white rounded-2xl shadow overflow-hidden hover:shadow-lg transition">

                @if($room->image)

                    <img src="{{ asset('storage/' . $room->image) }}"
                         class="w-full h-56 object-cover">

                @else

                    <div class="w-full h-56 bg-gray-200 flex items-center justify-center">

                        <span class="text-gray-500">
                            No Image
                        </span>

                    </div>

                @endif
                <div class="p-5">

                    <h3 class="text-2xl font-bold mb-3">

                        Room {{ $room->room_number }}

                    </h3>

                    <p class="mb-2 text-gray-700">

                        <strong>Type:</strong>
                        {{ $room->roomType->name }}

                    </p>

                    <p class="mb-2 text-gray-700">

                        <strong>Price:</strong>
                        ₹{{ $room->roomType->price_per_night }}

                    </p>

                    <p class="mb-4 text-gray-700">

                        <strong>Capacity:</strong>
                        {{ $room->roomType->capacity }} Guests

                    </p>

                    @if($room->is_available)

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Available
                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                            Unavailable
                        </span>

                    @endif
                    <div class="mt-5">

                        <a href="{{ route('reservations.create', ['room_id' => $room->id]) }}"
                           class="block text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-xl">

                            Book Now

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-3">

                <div class="bg-white p-6 rounded shadow text-center">

                    No rooms available.

                </div>

            </div>

        @endforelse

    </div>

</div>