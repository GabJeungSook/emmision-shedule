<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Schedule;

class ViewAvailableSchedules extends Component
{
    public $schedules;

    public function mount()
    {
        $this->schedules = Schedule::all();
    }

    public function render()
    {
        return view('livewire.user.view-available-schedules');
    }
}
