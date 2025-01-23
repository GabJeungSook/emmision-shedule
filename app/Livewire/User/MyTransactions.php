<?php

namespace App\Livewire\User;

use App\Models\Transaction;
use Livewire\Component;

class MyTransactions extends Component
{
    public $transactions;

    public function mount()
    {
        $this->transactions = Transaction::all();
    }

    public function render()
    {
        return view('livewire.user.my-transactions');
    }
}
