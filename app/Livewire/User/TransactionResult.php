<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\UserPayment;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionResult extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = UserPayment::find($record);
    }

    public function downloadPDF()
    {
        $schedule = Carbon::parse($this->record->application->schedule->date)->format('F d, Y').' - '.($this->record->application->convertHour);
        $data = [
            'full_name' => $this->record->user->userDetails->fullName,
            'transaction_number' => $this->record->transaction_number,
            'vehicle' => $this->record->vehicle->name,
            'plate_number' => $this->record->user->userDetails->plate_number,
            'schedule' => $schedule,
            'created_at' => Carbon::parse($this->record->created_at)->format('F d, Y'),
            'result' => $this->record->result->result
        ];
        $pdf = Pdf::loadView('pdf.result', $data);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'result.pdf');



        // Make sure the name is properly encoded in UTF-8
        // $data = [
        //     'name' => mb_convert_encoding('José Hernández', 'UTF-8', 'auto')  // Automatically converts the character set
        // ];

        // $pdf = Pdf::loadView('pdf.result', $data);
        // return $pdf->download('sample.pdf');
    }

    public function render()
    {
        return view('livewire.user.transaction-result');
    }
}
