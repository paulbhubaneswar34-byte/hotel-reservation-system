@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-6">
        Register
    </h2>

    <form method="POST" action="/register">

        @csrf

        <div class="mb-4">

            <label>Name</label>

            <input type="text"
                   name="name"
                   class="w-full border p-2 rounded">

            @error('name')
                <p class="text-red-500 text-sm">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div class="mb-4">

            <label>Email</label>

            <input type="email"
                   name="email"
                   class="w-full border p-2 rounded">

            @error('email')
                <p class="text-red-500 text-sm">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div class="mb-4">

            <label>Password</label>

            <input type="password"
                   name="password"
                   class="w-full border p-2 rounded">

        </div>

        <div class="mb-4">

            <label>Confirm Password</label>

            <input type="password"
                   name="password_confirmation"
                   class="w-full border p-2 rounded">

        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">

            Register

        </button>

    </form>

</div>

@endsection