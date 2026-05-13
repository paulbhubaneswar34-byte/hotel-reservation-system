<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\User;

class DashboardStats extends Component
{
    public $totalRooms;

    public $totalReservations;

    public $totalUsers;

    public function mount()
    {
        $this->totalRooms = Room::count();

        $this->totalReservations = Reservation::count();

        $this->totalUsers = User::count();
    }

    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}