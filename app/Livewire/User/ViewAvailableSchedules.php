<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\UserPayment;
use Carbon\Carbon;

class ViewAvailableSchedules extends Component
{
    public $schedules;
    public $transactions;

    public function mount()
    {
        $date_now = Carbon::now('Asia/Manila')->format('Y-m-d');
        $this->schedules = Schedule::where('date', '>=', $date_now)->get();
        $this->transactions = UserPayment::get();
    }

    public function render()
    {
        return view('livewire.user.view-available-schedules');
    }
}
