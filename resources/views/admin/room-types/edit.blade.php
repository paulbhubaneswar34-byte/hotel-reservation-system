@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">

        Edit Room Type

    </h1>

    <form method="POST"
          action="{{ route('admin.room-types.update', $roomType) }}">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label>Name</label>

            <input type="text"
                   name="name"
                   value="{{ $roomType->name }}"
                   class="w-full border p-2 rounded">

        </div>

        <div class="mb-4">

            <label>Description</label>

            <textarea name="description"
                      class="w-full border p-2 rounded">{{ $roomType->description }}</textarea>

        </div>

        <div class="mb-4">

            <label>Price</label>

            <input type="number"
                   name="price_per_night"
                   value="{{ $roomType->price_per_night }}"
                   class="w-full border p-2 rounded">

        </div>

        <div class="mb-4">

            <label>Capacity</label>

            <input type="number"
                   name="capacity"
                   value="{{ $roomType->capacity }}"
                   class="w-full border p-2 rounded">

        </div>

        <button class="bg-blue-600 hover:bg-blue-800 cursor-pointer text-white px-4 py-2 rounded">

            Update

        </button>

    </form>

</div>

@endsection