<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class Applications extends Component
{
    public $applications;

    public function mount()
    {
        $this->applications = Application::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.user.applications');
    }
}
