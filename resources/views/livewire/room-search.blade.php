<div>

    <!-- SEARCH SECTION -->
    <div class="bg-white p-6 rounded-2xl shadow mb-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Search -->
            <div>

                <label class="block mb-2 font-semibold text-gray-700">

                    Search Room Number

                </label>

                <input type="text"
                       wire:model.live="search"
                       placeholder="Enter room number..."
                       class="w-full border border-gray-300 p-3 rounded-lg">

            </div>

            <!-- Capacity Filter -->
            <div>

                <label class="block mb-2 font-semibold text-gray-700">

                    Filter By Capacity

                </label>

                <select wire:model.live="capacity"
                        class="w-full border border-gray-300 p-3 rounded-lg">

                    <option value="">
                        All Capacities
                    </option>

                    <option value="1">
                        1 Guest
                    </option>

                    <option value="2">
                        2 Guests
                    </option>

                    <option value="4">
                        4 Guests
                    </option>

                </select>

            </div>

        </div>

    </div>

    <!-- ROOM GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @forelse($rooms as $room)

            <div class="bg-white rounded-2xl shadow overflow-hidden hover:shadow-lg transition">

                <!-- IMAGE -->
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

                <!-- CONTENT -->
                <div class="p-5">

                    <h2 class="text-2xl font-bold mb-3">

                        Room {{ $room->room_number }}

                    </h2>

                    <p class="mb-2 text-gray-700">

                        <strong>Type:</strong>

                        {{ $room->roomType->name }}

                    </p>

                    <p class="mb-2 text-gray-700">

                        <strong>Price:</strong>

                        ₹{{ $room->roomType->price_per_night }}
                        / night

                    </p>

                    <p class="mb-4 text-gray-700">

                        <strong>Capacity:</strong>

                        {{ $room->roomType->capacity }}
                        Guests

                    </p>

                    <!-- STATUS -->
                    @if($room->is_available)

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                            Available

                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                            Unavailable

                        </span>

                    @endif

                    <!-- BUTTON -->
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

                <div class="bg-white p-8 rounded-2xl shadow text-center">

                    <p class="text-gray-500 text-lg">

                        No matching rooms found.

                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>