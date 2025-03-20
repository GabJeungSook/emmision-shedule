<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\UserPayment;
use Filament\Notifications\Notification;

class ScanQrCode extends Component
{
    public $scannedCode;

    public function redirectToTransaction()
    {
        $code = trim($this->scannedCode);
        $transaction = UserPayment::where('transaction_number', $this->scannedCode)->first();


        if($transaction && $transaction->status == 'Approved')
        {
            return redirect()->route('admin.add-result', $transaction->id);
        }elseif($transaction && $transaction->status != 'Approved')
        {
            Notification::make()
            ->title('Trasaction Not Approved')
            ->body('QR Code is not valid. Wait for the approval of the transaction')
            ->danger()
            ->send();

            $this->scannedCode = null;

        }
        else{
            Notification::make()
            ->title('Trasaction Not found')
            ->body('QR Code does not exist')
            ->danger()
            ->send();

            $this->scannedCode = null;
        }
    }

    public function render()
    {
        return view('livewire.admin.scan-qr-code');
    }
}
