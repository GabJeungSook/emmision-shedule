<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\TeamSSProgramSmsService;
use Filament\Notifications\Notification;

class Dashboard extends Component
{

    public function test()
    {
        $smsService = new TeamSSProgramSmsService();

        $number = '09272612630';
        $message = 'Test Message\n
        This is a test message from the TeamSSProgram SMS Service.';

        $response = $smsService->sendSms($number, $message);

        Notification::make()
        ->title('SMS Sent')
        ->success()
        ->body('SMS sent successfully to ' . $number)
        ->send();

    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
