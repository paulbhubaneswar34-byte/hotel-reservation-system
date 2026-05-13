@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">

        Add Room

    </h1>

    <form method="POST"
      enctype="multipart/form-data"
      action="{{ route('admin.rooms.store') }}">

        @csrf

        <div class="mb-4">

            <label>Room Type</label>

            <select name="room_type_id"
                    class="w-full border p-2 rounded">

                @foreach($roomTypes as $roomType)

                    <option value="{{ $roomType->id }}">

                        {{ $roomType->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label>Room Number</label>

            <input type="text"
                   name="room_number"
                   class="w-full border p-2 rounded">

        </div>
        <div class="mb-4">

    <label>Room Image</label>

    <input type="file"
           name="image"
           class="w-full border p-2 rounded">

</div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">

            Save

        </button>

    </form>

</div>

@endsection