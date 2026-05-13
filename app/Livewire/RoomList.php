<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;

class RoomList extends Component
{
    public $rooms = [];

    public function mount()
    {
        $this->rooms = Room::with('roomType')->get();
    }

    public function render()
    {
        return view('livewire.room-list');
    }
}