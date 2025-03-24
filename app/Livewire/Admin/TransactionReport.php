<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use App\Models\UserPayment;
use Livewire\Component;

class TransactionReport extends Component
{
    public $transactions;
    public $filter;
    public $start_date;
    public $end_date;

    public function mount()
    {
        $this->transactions = UserPayment::all();
    }

    //add a function to filter the transactions
    public function filterTransactions()
    {
        if ($this->start_date && $this->end_date) {
                $this->transactions = UserPayment::whereBetween('created_at', [
                    now()->setTimezone(config('app.timezone'))->createFromFormat('Y-m-d', $this->start_date)->startOfDay(),
                    now()->setTimezone(config('app.timezone'))->createFromFormat('Y-m-d', $this->end_date)->endOfDay()
                ])->get();
        }
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
