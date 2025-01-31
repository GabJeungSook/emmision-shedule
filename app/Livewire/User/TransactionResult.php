<?php

namespace App\Livewire\User;

use App\Models\UserPayment;
use Livewire\Component;

class TransactionResult extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = UserPayment::find($record);
    }

    public function render()
    {
        return view('livewire.user.transaction-result');
    }
}
