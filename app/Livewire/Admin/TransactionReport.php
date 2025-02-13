<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use App\Models\UserPayment;
use Livewire\Component;

class TransactionReport extends Component
{
    public $transactions;
    public $filter;

    public function mount()
    {
        $this->transactions = UserPayment::all();
    }

    public function updatedFilter()
    {
        switch ($this->filter) {
            case 'daily':
            $this->transactions = UserPayment::whereDate('created_at', now()->setTimezone(config('app.timezone'))->toDateString())->get();
            break;
            case 'weekly':
            $this->transactions = UserPayment::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->get();
            break;
            case 'monthly':
            $this->transactions = UserPayment::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->get();
            break;
            case 'annually':
            $this->transactions = UserPayment::whereYear('created_at', now()->year)->get();
            break;
            default:
            $this->transactions = UserPayment::all();
            break;
        }
    }

    public function render()
    {
        return view('livewire.admin.transaction-report');
    }
}
