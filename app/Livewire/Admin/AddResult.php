<?php

namespace App\Livewire\Admin;

use App\Mail\Result as MailResult;
use App\Models\Result;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\UserPayment;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

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
            RichEditor::make('result')
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
        $result = Result::create($this->form->getState());

        $result->userPayment->update([
            'status' => 'Completed'
        ]);

        Mail::to($this->record->user->userDetails->email)->send(new MailResult($result));


        Notification::make()
        ->title('Result added successfully')
        ->success()
        ->send();

        return redirect()->route('admin.results', $result);
    }

    public function render()
    {
        return view('livewire.admin.add-result');
    }
}
