<?php

namespace App\Livewire\Admin;

use App\Models\Schedule;
use Livewire\Component;

class CreateSchedule extends Component
{
    public $date;
    public $selectedHours = [];
    public $slots;

    public function mount()
    {
        $this->date = request()->input('date');
        $this->selectedHours = [
            '1' => true,
            '2' => true,
            '3' => true,
            '4' => true,
            '5' => true,
            '6' => true,
            '7' => true,
            '8' => true,
            '9' => true,
        ];
        $this->slots = 10;
    }

    public function render()
    {
        return view('livewire.admin.create-schedule');
    }

    public function confirmScheduleCreation()
    {
        // Create schedule
        $selectedHours = array_keys(array_filter($this->selectedHours));

        $schedule = Schedule::create([
            'date' => $this->date,
            'hours' => json_encode($selectedHours),
            'slots' => $this->slots,
        ]);

        return redirect()->route('admin.calendar');

    }
}
