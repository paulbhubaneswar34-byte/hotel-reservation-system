@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">

        Edit Room

    </h1>

    <form method="POST"
          enctype="multipart/form-data"
          action="{{ route('admin.rooms.update', $room) }}">

        @csrf
        @method('PUT')

        <!-- Room Type -->
        <div class="mb-4">

            <label class="block mb-2 font-semibold">

                Room Type

            </label>

            <select name="room_type_id"
                    class="w-full border p-3 rounded">

                @foreach($roomTypes as $roomType)

                    <option value="{{ $roomType->id }}"
                        {{ $room->room_type_id == $roomType->id ? 'selected' : '' }}>

                        {{ $roomType->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <!-- Room Number -->
        <div class="mb-4">

            <label class="block mb-2 font-semibold">

                Room Number

            </label>

            <input type="text"
                   name="room_number"
                   value="{{ $room->room_number }}"
                   class="w-full border p-3 rounded">

        </div>

        <!-- Availability -->
        <div class="mb-4">

            <label class="block mb-2 font-semibold">

                Availability

            </label>

            <select name="is_available"
                    class="w-full border p-3 rounded">

                <option value="1"
                    {{ $room->is_available ? 'selected' : '' }}>

                    Available

                </option>

                <option value="0"
                    {{ !$room->is_available ? 'selected' : '' }}>

                    Unavailable

                </option>

            </select>

        </div>

        <!-- Current Image -->
        @if($room->image)

            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Current Image

                </label>

                <img src="{{ asset('storage/' . $room->image) }}"
                     class="w-64 h-48 object-cover rounded shadow">

            </div>

        @endif

        <!-- Upload New Image -->
        <div class="mb-6">

            <label class="block mb-2 font-semibold">

                Change Room Image

            </label>

            <input type="file"
                   name="image"
                   class="w-full border p-3 rounded">

        </div>

        <!-- Submit -->
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 cursor-pointer text-white px-6 py-3 rounded">

            Update Room

        </button>

    </form>

</div>

@endsection