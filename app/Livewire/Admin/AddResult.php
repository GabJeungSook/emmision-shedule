<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\UserPayment;

class AddResult extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = UserPayment::find($record);
    }

    public function render()
    {
        return view('livewire.admin.add-result');
    }
}
