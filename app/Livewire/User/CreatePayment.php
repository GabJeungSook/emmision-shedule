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
use App\Services\TeamSSProgramSmsService;
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
        $this->form->fill([
            'user_id' => $this->user->id,
            'application_id' => $this->record->id,
            'transaction_number' => 'TRN' . rand(1000, 9999) . $this->user->id . date('Ymd'),
            'status' => 'Pending',
            'vehicle_id' => auth()->user()->userDetails->vehicle_id,
            'amount' => auth()->user()->userDetails->vehicle->amount,
            'payment_method' => 'gcash',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id'),
                Hidden::make('application_id'),
                TextInput::make('transaction_number')->label('Reference Number')->readOnly(),
                Hidden::make('status'),
                // Select::make('vehicle_id')
                // ->label('Vehicle')
                // ->options(Vehicle::all()->pluck('name', 'id'))
                // ->live()
                // ->afterStateUpdated(function (Set $set, ?string $state) {
                //     $set('amount', $state ? Vehicle::find($state)->amount : null);
                // })->required(),
                TextInput::make('vehicle_id')
                ->label('Vehicle')
                ->formatStateUsing(fn ($record) => $this->user->userDetails->vehicle->name)->readOnly()
                ->required(),
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
                        return new HtmlString('<img src="'.asset('images/maya.jpg').'" class="max-w-xs m-auto" />
                        <button wire:click="downloadImage(1)" style="background-color: #eda909; padding: 10px; margin-top: 10px; color: white; border-radius: 5px; display: block; margin-left: auto; margin-right: auto;">Download</button>');
                    }else{
                        return new HtmlString('<img src="'.asset('images/gcash.jpg').'" class="max-w-xs m-auto" />
                        <button wire:click="downloadImage(2)" style="background-color: #eda909; padding: 10px; margin-top: 10px; color: white; border-radius: 5px; display: block; margin-left: auto; margin-right: auto;">Download</button>');
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
                ->required()
            ])->statePath('data')
            ->model(UserPayment::class);
    }

    public function downloadImage($id)
    {
        switch($id)
        {
            case 1:
                $file = public_path('images/maya.jpg');
                break;
            case 2:
                $file = public_path('images/gcash.jpg');
                break;
        }

        return response()->download($file);
    }

    public function savePayment()
    {
        $this->validate();
        $vehicle = $this->form->getState();
        $id = Vehicle::where('name', $vehicle['vehicle_id'])->first()->id;
        $vehicle['vehicle_id'] = $id;
        $payment = UserPayment::create($vehicle);
        $this->record->status = 'Approved';
        $this->record->save();

        Notification::make()
        ->title('Payment saved successfully')
        ->success()
        ->send();

        return redirect()->route('user.view-transaction');
        // return redirect()->route('user.transaction-details', $this->record);
    }

    public function render()
    {
        return view('livewire.user.create-payment');
    }
}
