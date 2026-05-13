@extends('layouts.app')

@section('content')

<div class="py-6">

    <!-- HEADER -->
    <div
        class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6"
    >

        <div>

            <h1
                class="text-2xl sm:text-3xl font-bold text-gray-800"
            >

                Reservation Calendar

            </h1>

            <p class="text-gray-500 mt-1">

                Manage and monitor room bookings visually

            </p>

        </div>

        <!-- LEGEND -->
        <div
            class="flex flex-wrap gap-3 text-sm"
        >

            <div class="flex items-center gap-2">

                <div class="w-4 h-4 rounded bg-green-500"></div>

                <span>Approved</span>

            </div>

            <div class="flex items-center gap-2">

                <div class="w-4 h-4 rounded bg-yellow-500"></div>

                <span>Pending</span>

            </div>

            <div class="flex items-center gap-2">

                <div class="w-4 h-4 rounded bg-red-500"></div>

                <span>Rejected</span>

            </div>

        </div>

    </div>

    <!-- CARD -->
    <div
        class="bg-white rounded-2xl shadow-lg p-3 sm:p-6 overflow-hidden"
    >

        <div id="calendar"></div>

    </div>

</div>

<!-- EVENT MODAL -->
<div
    id="eventModal"
    class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center p-4"
>

    <div
        class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden"
    >

        <!-- HEADER -->
        <div
            class="bg-blue-600 text-white px-5 py-4 flex justify-between items-center"
        >

            <h2 class="text-xl font-bold">

                Reservation Details

            </h2>

            <button
                onclick="closeModal()"
                class="text-2xl"
            >

                &times;

            </button>

        </div>

        <!-- BODY -->
        <div class="p-5 space-y-4">

            <div>

                <h3 class="font-semibold text-gray-500">

                    Room

                </h3>

                <p id="modalRoom" class="text-lg font-bold"></p>

            </div>

            <div>

                <h3 class="font-semibold text-gray-500">

                    Guest

                </h3>

                <p id="modalGuest"></p>

            </div>

            <div>

                <h3 class="font-semibold text-gray-500">

                    Status

                </h3>

                <p id="modalStatus"></p>

            </div>

            <div>

                <h3 class="font-semibold text-gray-500">

                    Check In

                </h3>

                <p id="modalCheckIn"></p>

            </div>

            <div>

                <h3 class="font-semibold text-gray-500">

                    Check Out

                </h3>

                <p id="modalCheckOut"></p>

            </div>

        </div>

    </div>

</div>

<!-- FULLCALENDAR CSS -->
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css"
/>

<!-- FULLCALENDAR JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        let calendarEl = document.getElementById('calendar');

        let calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'dayGridMonth',

            height: 'auto',

            selectable: true,

            editable: false,

            events: '/calendar-events',

            headerToolbar: {

                left: 'prev,next today',

                center: 'title',

                right: window.innerWidth < 768
                    ? 'dayGridMonth'
                    : 'dayGridMonth,timeGridWeek,timeGridDay'

            },

            eventClick: function(info) {

                document.getElementById('modalRoom')
                    .innerText = info.event.extendedProps.room;

                document.getElementById('modalGuest')
                    .innerText = info.event.extendedProps.guest;

                document.getElementById('modalStatus')
                    .innerText = info.event.extendedProps.status;

                document.getElementById('modalCheckIn')
                    .innerText = info.event.start.toLocaleDateString();

                document.getElementById('modalCheckOut')
                    .innerText = info.event.end.toLocaleDateString();

                document
                    .getElementById('eventModal')
                    .classList.remove('hidden');
            },

            eventDidMount: function(info) {

                info.el.classList.add(
                    'rounded-lg',
                    'border-0',
                    'shadow-sm',
                    'cursor-pointer'
                );
            }

        });

        calendar.render();

    });

    function closeModal() {

        document
            .getElementById('eventModal')
            .classList.add('hidden');

    }

</script>

@endsection