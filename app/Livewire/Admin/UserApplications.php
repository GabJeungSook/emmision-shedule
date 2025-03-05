<?php

namespace App\Livewire\Admin;

use App\Mail\ApplicationStatus;
use App\Models\Application;
use Filament\Tables;
use Livewire\Component;
use App\Models\Schedule;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Actions\StaticAction;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class UserApplications extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Application::query())
            ->columns([
                TextColumn::make('transaction_number')->searchable()->label('Transaction Number'),
                 TextColumn::make('user.userDetails.FullName')->label('Full Name'),
                 TextColumn::make('schedule.date')->label('Schedule Date')->date('F j, Y'),
                 TextColumn::make('convertHour')->label('TIme'),
                 TextColumn::make('status')->label('Status')->formatStateUsing(fn ($record) => strtoupper($record->status)),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Tables\Actions\Action::make('view_or_cr')
                ->label('View OR/CR')
                ->icon('heroicon-s-eye')
                ->button()
                ->color('success')
                ->modalHeading('OR/CR')
                ->modalSubmitAction(false)
                ->modalContent(function (Model $record) {
                    return view('user.or_cr', ['record' => $record]);
                })
                ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                ->closeModalByClickingAway(false)->modalWidth('2xl')->visible(fn ($record) => $record->status === 'Pending'),
                Tables\Actions\Action::make('Approve')
                ->icon('heroicon-s-check-circle')
                ->button()
                ->color('success')
                ->action(function (Model $record) {

                    $record->status = "For Payment";
                    $record->save();

                    Mail::to($record->user->userDetails->email)->send(new ApplicationStatus($record));
                    Notification::make()
                    ->title('Application approved')
                    ->success()
                    ->body('Application can now proceed to payment transaction. An email was sent to the customer.')
                    ->send();

                })->requiresConfirmation()->visible(fn ($record) => $record->status === 'Pending'),
                Tables\Actions\Action::make('Reject')
                ->icon('heroicon-s-x-circle')
                ->button()
                ->color('danger')
                ->action(function (Model $record) {

                    $record->status = "Rejected";
                    $record->save();

                    Mail::to($record->user->userDetails->email)->send(new ApplicationStatus($record));
                    Notification::make()
                    ->title('Application rejected')
                    ->danger()
                    ->body('Application was rejected. An email was sent to the customer.')
                    ->send();

                })->requiresConfirmation()->visible(fn ($record) => $record->status === 'Pending'),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.user-applications');
    }
}
