<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\UserPayment;

class UserReceipt extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = UserPayment::find($record);
    }
    
    public function render()
    {
        return view('livewire.user.user-receipt');
    }
}
