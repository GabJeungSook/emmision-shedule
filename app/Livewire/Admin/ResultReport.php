<?php

namespace App\Livewire\Admin;

use App\Models\Result;
use Livewire\Component;

class ResultReport extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = Result::find($record);
    }

    public function render()
    {
        return view('livewire.admin.result-report');
    }
}
