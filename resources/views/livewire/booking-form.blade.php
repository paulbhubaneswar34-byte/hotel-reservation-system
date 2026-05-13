<div class="bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-6">
        Book Room
    </h2>

    @if($successMessage)

        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">

            {{ $successMessage }}

        </div>

    @endif

    <form wire:submit="submit">

        <div class="mb-4">

            <label class="block mb-2">
                Select Room
            </label>

            <select wire:model="room_id"
                    class="w-full border p-2 rounded">

                <option value="">
                    Choose Room
                </option>

                @foreach($rooms as $room)

                    <option value="{{ $room->id }}">

                        Room {{ $room->room_number }}

                    </option>

                @endforeach

            </select>

            @error('room_id')
                <p class="text-red-500">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Check In
            </label>

            <input type="date"
                   wire:model="check_in_date"
                   class="w-full border p-2 rounded">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Check Out
            </label>

            <input type="date"
                   wire:model="check_out_date"
                   class="w-full border p-2 rounded">

        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">

            Book Now

        </button>

    </form>

</div>