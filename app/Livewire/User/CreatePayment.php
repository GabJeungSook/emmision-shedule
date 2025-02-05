<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Application;
use App\Models\User;
use App\Models\UserPayment;
use App\Models\Vehicle;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use Filament\Forms\Set;
use DB;

class CreatePayment extends Component implements HasForms
{
    use InteractsWithForms;

    public $record;
    public $user;
    public ?array $data = [];

    public function mount($record)
    {
        $this->record = Application::find($record);
        $this->user = User::find(Auth::user()->id);
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')->default($this->user->id),
                Hidden::make('application_id')->default($this->record->id),
                Hidden::make('transaction_number')->default('TRN' . rand(1000, 9999) . $this->user->id . date('Ymd')),
                Hidden::make('status')->default('Pending'),
                Select::make('vehicle_id')
                ->label('Vehicle')
                ->options(Vehicle::all()->pluck('name', 'id'))
                ->live()
                ->afterStateUpdated(function (Set $set, ?string $state) {
                    $set('amount', $state ? Vehicle::find($state)->amount : null);
                })->required(),
                TextInput::make('amount')->readOnly()->required(),
                Radio::make('payment_method')
                ->live()
                ->options([
                    'gcash' => 'GCash',
                    'maya' => 'Maya',
                ])->default('gcash')->inline()->required(),
                Placeholder::make('payment_image')
                ->content(function($get) {
                    if ($get('payment_method') == 'maya') {
                        return new HtmlString('<img src="'.asset('images/maya.jpg').'" class="max-w-xs m-auto" />');
                    }else{
                        return new HtmlString('<img src="'.asset('images/gcash.jpg').'" class="max-w-xs m-auto" />');
                    }
                    // return new HtmlString('<img src="'.asset('images/gcash.jpg').'" class="max-w-xs m-auto" />');
                })->label(''),
                FileUpload::make('attachment')
                ->label('Receipt')
                ->preserveFileNames()
                ->disk('public')
                ->directory('receipts')
                ->label('Upload Receipt Image')
                ->uploadingMessage('Uploading receipt...')
                ->image()
            ])->statePath('data')
            ->model(UserPayment::class);;
    }

    public function savePayment()
    {
        $this->validate();

        $payment = UserPayment::create($this->form->getState());
        $this->record->status = 'Paid';
        $this->record->save();

        Notification::make()
        ->title('Payment saved successfully')
        ->success()
        ->send();

        return redirect()->route('user.transaction-details', $this->record->id);
    }

    public function render()
    {
        return view('livewire.user.create-payment');
    }
}
