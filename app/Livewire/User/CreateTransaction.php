<?php

namespace App\Livewire\User;

use App\Models\Vehicle;
use App\Models\Schedule;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Application;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Forms\Set;

class CreateTransaction extends Component implements HasForms
{

    use InteractsWithForms;

    public $record;
    public $user;
    public $selected_hour;
    public ?array $data = [];

    public function mount($record)
    {
        $this->record = Schedule::find($record);
        $this->user = User::find(Auth::user()->id);
        $this->form->fill();
    }

    public function updatedSelectedHour($value)
    {
        $this->data['hour'] = $value;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')->default($this->user->id),
                Hidden::make('schedule_id')->default($this->record->id),
                Hidden::make('hour'),
                Hidden::make('transaction_number')->default('TRN' . rand(1000, 9999) . $this->user->id . date('Ymd')),
                Hidden::make('status')->default('Pending'),
                FileUpload::make('attachment')
                ->label('Receipt')
                ->preserveFileNames()
                ->disk('public')
                ->directory('or_cr')
                ->label('Upload OR/CR')
                ->uploadingMessage('Uploading OR/CR...')
                ->image()
                ->required()
            ])->statePath('data')
            ->model(Application::class);
    }

    public function saveTransaction()
    {
        if($this->selected_hour)
        {
            Application::create($this->form->getState());

            Notification::make()
            ->title('Payment saved successfully')
            ->body('Please wait for the admin to approve your payment application')
            ->success()
            ->send();

            return redirect()->route('user.applications');
        }else{

            Notification::make()
            ->title('Please select a schedule')
            ->danger()
            ->send();

        }
        // $this->validate();
        // $this->data['hour'] = $this->selected_hour;
        // $transaction = Transaction::create($this->form->getState());

        // Notification::make()
        // ->title('Transaction saved successfully')
        // ->success()
        // ->send();



    }

    public function render()
    {
        return view('livewire.user.create-transaction');
    }
}
