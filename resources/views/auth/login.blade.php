@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-6">
        Login
    </h2>

    <form method="POST" action="/login">

        @csrf

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

        <button class="bg-blue-600 hover:bg-blue-800 cursor-pointer text-white px-4 py-2 rounded">

            Login

        </button>

    </form>

</div>

@endsection