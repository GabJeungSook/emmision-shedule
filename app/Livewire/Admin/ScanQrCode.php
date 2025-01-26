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
        $transaction = UserPayment::where('transaction_number', $this->scannedCode)->first();

        if($transaction)
        {
            return redirect()->route('admin.add-result', $transaction->id);
        }else{
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
