<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\UserPayment;

class UserTransactionDetails extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = UserPayment::find($record);
    }

    public function render()
    {
        return view('livewire.user.user-transaction-details');
    }
}
