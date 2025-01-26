<?php

namespace App\Livewire\Admin;

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


class UserApplications extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Application::query())
            ->columns([
                TextColumn::make('transaction_number')->label('Transaction Number'),
                 TextColumn::make('user.userDetails.FullName')->searchable()->label('Full Name'),
                 TextColumn::make('schedule.date')->label('Schedule Date')->date('F j, Y'),
                 TextColumn::make('convertHour')->label('TIme'),
                 TextColumn::make('status')->label('Status')->formatStateUsing(fn ($record) => strtoupper($record->status)),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Tables\Actions\Action::make('Approve')
                ->icon('heroicon-s-check-circle')
                ->button()
                ->color('success')
                ->action(function ($record) {
                    $record->status = "For Payment";
                    $record->save();

                    Notification::make()
                    ->title('Application approved')
                    ->body('application can now proceed to payment transaction')
                    ->success()
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
