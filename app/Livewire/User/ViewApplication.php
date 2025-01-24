<?php

namespace App\Livewire\User;

use App\Models\Application;
use Livewire\Component;

class ViewApplication extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = Application::find($record);
    }
    public function render()
    {
        return view('livewire.user.view-application');
    }
}
