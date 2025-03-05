<?php

namespace App\Livewire\Admin;

use Filament\Tables;
use Livewire\Component;
use App\Models\Schedule;
use Filament\Tables\Table;
use App\Models\Application;
use App\Models\Transaction;
use App\Models\UserPayment;
use Filament\Actions\StaticAction;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ViewSchedule extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $record;
    public $transactions;

    public function mount($record)
    {
        $this->record = Schedule::find($record);
        $this->transactions = UserPayment::get();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Application::query()->where('schedule_id', $this->record->id)->whereHas('userPayment', function($query) {
                $query->where('status', 'Approved');
            }))
            ->columns([
                TextColumn::make('transaction_number')->label('Transaction Number'),
                 TextColumn::make('user.userDetails.FullName')->searchable()->label('Full Name'),
                 TextColumn::make('schedule.date')->label('Schedule Date')->date('F j, Y'),
                 TextColumn::make('convertHour')->label('Time'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // Tables\Actions\Action::make('View Receipt')
                // ->icon('heroicon-s-eye')
                // ->button()
                // ->color('success')
                // ->modalHeading('Receipt')
                // ->modalSubmitAction(false)
                // ->modalContent(function (Model $record) {
                //     return view('user.receipt', ['record' => $record]);
                // })
                // ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                // ->closeModalByClickingAway(false)->modalWidth('lg'),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function cancelSchedule()
    {
        $this->record->delete();

        Notification::make()
        ->title('Success')
        ->success()
        ->body('Schedule has been cancelled.')
        ->send();

        return redirect()->route('admin.calendar');
    }

    public function render()
    {
        return view('livewire.admin.view-schedule');
    }
}
