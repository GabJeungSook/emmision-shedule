<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use Livewire\Component;

class TransactionReport extends Component
{
    public $transactions;

    public function mount()
    {
        $this->transactions = Transaction::all();
    }

    public function render()
    {
        return view('livewire.admin.transaction-report');
    }
}
