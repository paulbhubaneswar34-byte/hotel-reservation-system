<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>

        Hotel Reservation System

    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @livewireStyles

</head>

<body class="bg-gray-100 min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-blue-600 shadow-lg">

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
        >

            <div
                class="flex justify-between h-16"
            >

                <!-- LEFT -->
                <div
                    class="flex items-center gap-8"
                >

                    <!-- LOGO -->
                    <a
                        href="{{ auth()->check()
                            ? (
                                auth()->user()->role === 'admin'
                                    ? route('admin.dashboard')
                                    : route('dashboard')
                            )
                            : '/'
                        }}"
                        class="text-white text-xl font-bold"
                    >

                        Hotel Reservation System

                    </a>

                    @auth

                        <!-- DESKTOP MENU -->
                        <div
                            class="hidden md:flex items-center gap-6"
                        >

                            <!-- ========================= -->
                            <!-- ADMIN NAVIGATION -->
                            <!-- ========================= -->

                            @if(auth()->user()->role === 'admin')

                                <a
                                    href="{{ route('admin.dashboard') }}"
                                    class="text-white hover:text-gray-200"
                                >

                                    Dashboard

                                </a>

                                <a
                                    href="{{ route('admin.room-types.index') }}"
                                    class="text-white hover:text-gray-200"
                                >

                                    Room Types

                                </a>

                                <a
                                    href="{{ route('admin.rooms.index') }}"
                                    class="text-white hover:text-gray-200"
                                >

                                    Rooms

                                </a>

                                <a
                                    href="{{ route('admin.reservations.index') }}"
                                    class="text-white hover:text-gray-200"
                                >

                                    Reservations

                                </a>

                                <a
                                    href="{{ route('admin.calendar') }}"
                                    class="text-white hover:text-gray-200"
                                >

                                    Calendar

                                </a>

                            @else

                                <!-- ========================= -->
                                <!-- USER NAVIGATION -->
                                <!-- ========================= -->

                                <a
                                    href="{{ route('dashboard') }}"
                                    class="text-white hover:text-gray-200"
                                >

                                    Dashboard

                                </a>

                                <a
                                    href="{{ route('rooms') }}"
                                    class="text-white hover:text-gray-200"
                                >

                                    Rooms

                                </a>

                                <a
                                    href="{{ route('reservations.index') }}"
                                    class="text-white hover:text-gray-200"
                                >

                                    My Reservations

                                </a>

                                <a
                                    href="{{ route('calendar') }}"
                                    class="text-white hover:text-gray-200"
                                >

                                    Calendar

                                </a>

                            @endif

                        </div>

                    @endauth

                </div>

                <!-- RIGHT -->
                <div
                    class="flex items-center gap-4"
                >

                    @auth

                        <!-- USER NAME -->
                        <div
                            class="hidden md:block text-white"
                        >

                            {{ auth()->user()->name }}

                        </div>

                        <!-- LOGOUT -->
                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="bg-red-500 hover:bg-red-600 cursor-pointer text-white px-4 py-2 rounded-lg"
                            >

                                Logout

                            </button>

                        </form>

                    @else

                        <!-- LOGIN -->
                        <a
                            href="{{ route('login') }}"
                            class="text-white"
                        >

                            Login

                        </a>

                        <!-- REGISTER -->
                        <a
                            href="{{ route('register') }}"
                            class="bg-white text-blue-600 px-4 py-2 rounded-lg"
                        >

                            Register

                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>

    <!-- MOBILE NAVIGATION -->
    @auth

        <div
            class="md:hidden bg-blue-700 px-4 py-4 flex flex-col gap-3"
        >

            <!-- ADMIN -->
            @if(auth()->user()->role === 'admin')

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-white"
                >

                    Dashboard

                </a>

                <a
                    href="{{ route('admin.room-types.index') }}"
                    class="text-white"
                >

                    Room Types

                </a>

                <a
                    href="{{ route('admin.rooms.index') }}"
                    class="text-white"
                >

                    Rooms

                </a>

                <a
                    href="{{ route('admin.reservations.index') }}"
                    class="text-white"
                >

                    Reservations

                </a>

                <a
                    href="{{ route('admin.calendar') }}"
                    class="text-white"
                >

                    Calendar

                </a>

            @else

                <!-- USER -->

                <a
                    href="{{ route('dashboard') }}"
                    class="text-white"
                >

                    Dashboard

                </a>

                <a
                    href="{{ route('rooms') }}"
                    class="text-white"
                >

                    Rooms

                </a>

                <a
                    href="{{ route('reservations.index') }}"
                    class="text-white"
                >

                    My Reservations

                </a>

                <a
                    href="{{ route('calendar') }}"
                    class="text-white"
                >

                    Calendar

                </a>

            @endif

        </div>

    @endauth

    <!-- MAIN CONTENT -->
    <main
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"
    >

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))

            <div
                class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6"
            >

                {{ session('success') }}

            </div>

        @endif

        <!-- ERROR MESSAGE -->
        @if($errors->any())

            <div
                class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-6"
            >

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>

                            {{ $error }}

                        </li>

                    @endforeach

                </ul>

            </div>

        @endif

        @yield('content')

    </main>

    @livewireScripts

</body>

</html>