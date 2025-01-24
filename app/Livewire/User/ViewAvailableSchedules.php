<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\Transaction;

class ViewAvailableSchedules extends Component
{
    public $schedules;
    public $transactions;

    public function mount()
    {
        $this->schedules = Schedule::all();
        $this->transactions = Transaction::get();
    }

    public function render()
    {
        return view('livewire.user.view-available-schedules');
    }
}
