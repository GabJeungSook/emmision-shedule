<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Result;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\UserPayment;
use App\Mail\Result as MailResult;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class AddResult extends Component implements HasForms
{

    use InteractsWithForms;
    public $record;
    public $user;
    public ?array $data = [];

    public function mount($record)
    {
        $this->record = UserPayment::find($record);
        $this->user = User::find($this->record->user_id);
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Hidden::make('user_payment_id')->default($this->record->id),
            Hidden::make('user_id')->default($this->user->id),
            Grid::make(2)
                ->schema([
                    TextInput::make('co')->label('CO (%)')->numeric()->minValue(0)->maxValue(100),
                    TextInput::make('hc')->label('HC (%)')->numeric()->minValue(0)->maxValue(100),
                    TextInput::make('co2')->label('CO2 (%)')->numeric()->minValue(0)->maxValue(100),
                    TextInput::make('o2')->label('O2 (%)')->numeric()->minValue(0)->maxValue(100),
                    TextInput::make('lambda'),
                    TextInput::make('nox')->label('NOx'),
                ]),
                FileUpload::make('attachment')
                ->label('Result Photo')
                ->preserveFileNames()
                ->disk('public')
                ->directory('results')
                ->label('Upload Result Image')
                ->uploadingMessage('Uploading Result...')
                ->image()
                ->required(),
                Select::make('passed_or_failed')
                ->label('Result')
                ->options([
                    'Passed' => 'Passed',
                    'Failed' => 'Failed',
                ])
                ->default('Passed')
                ->required(),
                RichEditor::make('result')
                ->label('Purpose')
                ->toolbarButtons([
                    'bold',
                    'bulletList',
                    'italic',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ])
                ->required()
            ])->statePath('data');
    }

    public function confirmTransactionResult()
    {
        $record = Result::create($this->form->getState());

        $record->userPayment->update([
            'status' => 'Completed'
        ]);

        Mail::to($this->record->user->userDetails->email)->send(new MailResult($record));


        Notification::make()
        ->title('Result added successfully')
        ->success()
        ->send();

       return redirect()->route('admin.results');
    }

    public function render()
    {
        return view('livewire.admin.add-result');
    }
}
