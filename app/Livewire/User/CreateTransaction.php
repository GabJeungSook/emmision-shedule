<?php

namespace App\Livewire\User;

use App\Models\Vehicle;
use App\Models\Schedule;
use App\Models\Transaction;
use App\Models\User;
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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')->default($this->user->id),
                Hidden::make('schedule_id')->default($this->record->id),
                Hidden::make('hour')->default($this->selected_hour),
                Hidden::make('transaction_number')->default('TRN' . rand(1000, 9999) . $this->user->id . date('Ymd')),
                Hidden::make('status')->default('Paid'),
                Select::make('vehicle_id')
                ->options(Vehicle::all()->pluck('name', 'id'))
                ->live()
                ->afterStateUpdated(function (Set $set, ?string $state) {
                    $set('amount', $state ? Vehicle::find($state)->amount : null);
                })->required(),
                TextInput::make('amount')->readOnly()->required(),
                Radio::make('payment_method')
                ->options([
                    'gcash' => 'GCash',
                    'maya' => 'Maya',
                ])->default('gcash')->inline()->required(),
                FileUpload::make('attachment')
                ->label('Receipt')
                ->preserveFileNames()
                ->disk('public')
                ->directory('receipts')
                ->label('Upload Receipt Image')
                ->uploadingMessage('Uploading receipt...')
                ->image()
            ])->statePath('data')
            ->model(Transaction::class);;
    }

    public function saveTransaction()
    {
        $this->validate();
        $this->data['hour'] = $this->selected_hour;
        $transaction = Transaction::create($this->form->getState());

        Notification::make()
        ->title('Transaction saved successfully')
        ->success()
        ->send();

        return redirect()->route('user.view-transaction');

    }

    public function render()
    {
        return view('livewire.user.create-transaction');
    }
}
