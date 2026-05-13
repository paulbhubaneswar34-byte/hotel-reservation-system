@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">

        Add Room Type

    </h1>

    <form method="POST"
          action="{{ route('admin.room-types.store') }}">

        @csrf

        <div class="mb-4">

            <label>Name</label>

            <input type="text"
                   name="name"
                   class="w-full border p-2 rounded">

        </div>

        <div class="mb-4">

            <label>Description</label>

            <textarea name="description"
                      class="w-full border p-2 rounded"></textarea>

        </div>

        <div class="mb-4">

            <label>Price Per Night</label>

            <input type="number"
                   name="price_per_night"
                   class="w-full border p-2 rounded">

        </div>

        <div class="mb-4">

            <label>Capacity</label>

            <input type="number"
                   name="capacity"
                   class="w-full border p-2 rounded">

        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">

            Save

        </button>

    </form>

</div>

@endsection