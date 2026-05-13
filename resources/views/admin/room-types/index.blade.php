@extends('layouts.app')

@section('content')

<div class="py-6">

    <!-- HEADER -->
    <div
        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6"
    >

        <div>

            <h1
                class="text-2xl sm:text-3xl font-bold text-gray-800"
            >

                Room Types

            </h1>

            <p class="text-gray-500 mt-1">

                Manage hotel room categories

            </p>

        </div>

        <!-- ADD BUTTON -->
        <a
            href="{{ route('admin.room-types.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow text-center"
        >

            Add Room Type

        </a>

    </div>

    <!-- TABLE CARD -->
    <div
        class="bg-white rounded-2xl shadow overflow-hidden"
    >

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <!-- TABLE HEADER -->
                <thead class="bg-gray-100">

                    <tr>

                        <th
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700"
                        >

                            ID

                        </th>

                        <th
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700"
                        >

                            Name

                        </th>

                        <th
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700"
                        >

                            Description

                        </th>

                        <th
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700"
                        >

                            Price

                        </th>

                        <th
                            class="px-6 py-4 text-center text-sm font-semibold text-gray-700"
                        >

                            Actions

                        </th>

                    </tr>

                </thead>

                <!-- TABLE BODY -->
                <tbody>

                    @forelse($roomTypes as $roomType)

                        <tr
                            class="border-b hover:bg-gray-50 transition"
                        >

                            <!-- ID -->
                            <td class="px-6 py-4">

                                {{ $roomType->id }}

                            </td>

                            <!-- NAME -->
                            <td class="px-6 py-4 font-semibold">

                                {{ $roomType->name }}

                            </td>

                            <!-- DESCRIPTION -->
                            <td class="px-6 py-4 text-gray-600">

                                {{ $roomType->description }}

                            </td>

                            <!-- PRICE -->
                            <td class="px-6 py-4 text-green-600 font-bold">

                                ₹{{ $roomType->price_per_night }}

                            </td>

                            <!-- ACTIONS -->
                            <td class="px-6 py-4">

                                <div
                                    class="flex flex-col sm:flex-row gap-2 justify-center"
                                >

                                    <!-- EDIT -->
                                    <a
                                        href="{{
                                            route(
                                                'admin.room-types.edit',
                                                $roomType
                                            )
                                        }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-center"
                                    >

                                        Edit

                                    </a>

                                    <!-- DELETE -->
                                    <form
                                        action="{{
                                            route(
                                                'admin.room-types.destroy',
                                                $roomType
                                            )
                                        }}"
                                        method="POST"
                                        onsubmit="
                                            return confirm(
                                                'Delete this room type?'
                                            )
                                        "
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="bg-red-500 hover:bg-red-600 cursor-pointer text-white px-4 py-2 rounded-lg w-full"
                                        >

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <!-- EMPTY -->
                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-10 text-center text-gray-500"
                            >

                                No room types found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection