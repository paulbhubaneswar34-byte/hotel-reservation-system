<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;
use App\Models\Reservation;

class BookingForm extends Component
{
    public $room_id;

    public $check_in_date;

    public $check_out_date;

    public $successMessage;

    public function submit()
    {
        $this->validate([
            'room_id' => 'required',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        Reservation::create([
            'user_id' => auth()->id(),
            'room_id' => $this->room_id,
            'check_in_date' => $this->check_in_date,
            'check_out_date' => $this->check_out_date,
            'total_price' => 1000,
        ]);

        $this->successMessage = 'Reservation created successfully';

        $this->reset([
            'room_id',
            'check_in_date',
            'check_out_date'
        ]);
    }

    public function render()
    {
        return view('livewire.booking-form', [
            'rooms' => Room::all()
        ]);
    }
}