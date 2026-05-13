@extends('layouts.app')

@section('content')

<div class="container mx-auto">

    <!-- Page Header -->
    <div class="mb-8">

        <h1 class="text-4xl font-bold text-gray-800 mb-2">

            Browse Available Rooms

        </h1>

        <p class="text-gray-600">

            Search and filter rooms based on room number and guest capacity.

        </p>

    </div>

    <!-- Livewire Search Component -->
    <livewire:room-search />

</div>

@endsection