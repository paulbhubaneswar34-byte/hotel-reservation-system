<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;

class RoomSearch extends Component
{
    public $search = '';

    public $capacity = '';

    public function render()
    {
        $rooms = Room::with('roomType')
            ->when($this->search, function ($query) {

                $query->where('room_number', 'like', '%' . $this->search . '%');
            })
            ->when($this->capacity, function ($query) {

                $query->whereHas('roomType', function ($q) {

                    $q->where('capacity', $this->capacity);
                });
            })
            ->get();

        return view('livewire.room-search', [
            'rooms' => $rooms
        ]);
    }
}