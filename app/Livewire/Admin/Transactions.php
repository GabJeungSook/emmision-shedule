<?php

namespace App\Livewire\Admin;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\Transaction;
use App\Models\UserPayment;
use Filament\Actions\StaticAction;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Notifications\Notification;

class Transactions extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(UserPayment::query())
            ->columns([
                TextColumn::make('user.userDetails.fullName')->searchable()->label('Full Name'),
                TextColumn::make('transaction_number')->searchable()->label('Transaction Number'),
                TextColumn::make('application.schedule.date')->label('Schedule Date')->date('F j, Y'),
                TextColumn::make('application.convertHour')->label('Time'),
                TextColumn::make('payment_method')->label('Payment Method')->formatStateUsing(fn (?string $state) => strtoupper($state)),
                TextColumn::make('vehicle.name')->label('Vehicle'),
                TextColumn::make('vehicle.amount')->label('Amount')->formatStateUsing(fn (?string $state) => '₱ '.number_format($state, 2)),
                TextColumn::make('status')->label('Status'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // Tables\Actions\Action::make('View')
                // ->icon('heroicon-s-eye')
                // ->button()
                // ->color('success')
                // ->modalHeading('Transaction QR Code')
                // ->modalSubmitAction(false)
                // ->modalContent(function (Model $record) {
                //     return view('user.qr-code', ['record' => $record]);
                // })
                // ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                // ->closeModalByClickingAway(false)->modalWidth('lg'),
                Tables\Actions\Action::make('View Receipt')
                ->icon('heroicon-s-eye')
                ->button()
                ->color('success')
                ->modalHeading('Receipt')
                ->modalSubmitAction(false)
                ->modalContent(function (Model $record) {
                    return view('user.receipt', ['record' => $record]);
                })
                ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                ->closeModalByClickingAway(false)->modalWidth('lg'),
                Tables\Actions\Action::make('qr')
                ->label("View QR Code")
                ->icon('heroicon-s-eye')
                ->button()
                ->color('success')
                ->modalHeading('QR Code')
                ->modalSubmitAction(false)
                ->modalContent(function (Model $record) {
                    return view('user.qr-code', ['record' => $record]);
                })
                ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                ->closeModalByClickingAway(false)->modalWidth('lg'),
                Tables\Actions\Action::make('Approve Payment')
                ->icon('heroicon-s-check-circle')
                ->button()
                ->color('success')
                ->action(function ($record) {
                    $record->status = "Approved";
                    $record->save();

                    Notification::make()
                    ->title('Payment approved')
                    ->body('transaction can now proceed to emission')
                    ->success()
                    ->send();
                })->requiresConfirmation()->visible(fn ($record) => $record->status === "Paid"),
                Tables\Actions\Action::make('add_result')
                ->label("Add Result")
                ->icon('heroicon-s-plus')
                ->button()
                ->color('success')
                ->url(fn (UserPayment $record): string => route('admin.add-result', $record))
                ->openUrlInNewTab(),
            ])
            ->bulkActions([
                // ...
            ]);
            // ->query(Transaction::query())
            // ->columns([
            //     TextColumn::make('transaction_number')->searchable()->label('Transaction Number'),
            //     TextColumn::make('user.userDetails.fullName')->label('Full Name'),
            //     TextColumn::make('schedule.date')->label('Date')->date('F j, Y'),
            //     TextColumn::make('convertHour')->label('Schedule'),
            //     TextColumn::make('payment_method')->label('Payment Method')->formatStateUsing(fn (?string $state) => strtoupper($state)),
            //     TextColumn::make('vehicle.name')->label('Vehicle'),
            //     TextColumn::make('vehicle.amount')->label('Amount')->formatStateUsing(fn (?string $state) => '₱ '.number_format($state, 2)),
            // ])
            // ->filters([
            //     // ...
            // ])
            // ->actions([
            //     Tables\Actions\Action::make('View')
            //     ->label('View QR Code')
            //     ->icon('heroicon-s-eye')
            //     ->button()
            //     ->color('success')
            //     ->modalHeading('Transaction QR Code')
            //     ->modalSubmitAction(false)
            //     ->modalContent(function (Model $record) {
            //         return view('user.qr-code', ['record' => $record]);
            //     })
            //     ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
            //     ->closeModalByClickingAway(false)->modalWidth('lg'),
            //     Tables\Actions\Action::make('View Receipt')
            //     ->icon('heroicon-s-eye')
            //     ->button()
            //     ->color('success')
            //     ->modalHeading('Receipt')
            //     ->modalSubmitAction(false)
            //     ->modalContent(function (Model $record) {
            //         return view('user.receipt', ['record' => $record]);
            //     })
            //     ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
            //     ->closeModalByClickingAway(false)->modalWidth('lg'),
            // ])
            // ->bulkActions([
            //     // ...
            // ]);
    }

    public function render()
    {
        return view('livewire.admin.transactions');
    }
}
