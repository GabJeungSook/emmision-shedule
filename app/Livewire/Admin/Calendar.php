<?php

namespace App\Livewire\Admin;

use App\Models\Schedule;
use Carbon\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public $schedules;

    public function mount()
    {
        $date_now = Carbon::parse(now())->format('Y-m-d');
        $this->schedules = Schedule::where('date', '>=', $date_now)->get();
    }

    public function render()
    {
        return view('livewire.admin.calendar');
    }
}
