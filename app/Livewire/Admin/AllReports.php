<?php

namespace App\Livewire\Admin;

use App\Models\Result;
use Livewire\Component;

class AllReports extends Component
{
    public $results;

    public function mount()
    {
        $this->results = Result::all();
    }

    public function render()
    {
        return view('livewire.admin.all-reports');
    }
}
