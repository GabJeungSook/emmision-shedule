<?php

namespace App\Livewire\Admin;

use App\Models\Schedule;
use Livewire\Component;

class Calendar extends Component
{
    public $schedules;

    public function mount()
    {
        $this->schedules = Schedule::all();
    }

    public function render()
    {
        return view('livewire.admin.calendar');
    }
}
