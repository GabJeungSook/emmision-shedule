<?php

namespace App\Livewire\Admin;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Actions\StaticAction;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Transactions extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Transaction::query())
            ->columns([
                TextColumn::make('transaction_number')->searchable()->label('Transaction Number'),
                TextColumn::make('user.userDetails.fullName')->searchable()->label('Full Name'),
                TextColumn::make('schedule.date')->label('Date')->date('F j, Y'),
                TextColumn::make('convertHour')->label('Schedule'),
                TextColumn::make('payment_method')->label('Payment Method')->formatStateUsing(fn (?string $state) => strtoupper($state)),
                TextColumn::make('vehicle.name')->label('Vehicle'),
                TextColumn::make('vehicle.amount')->label('Amount')->formatStateUsing(fn (?string $state) => '₱ '.number_format($state, 2)),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Tables\Actions\Action::make('View')
                ->icon('heroicon-s-eye')
                ->button()
                ->color('success')
                ->modalHeading('Transaction QR Code')
                ->modalSubmitAction(false)
                ->modalContent(function (Model $record) {
                    return view('user.qr-code', ['record' => $record]);
                })
                ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                ->closeModalByClickingAway(false)->modalWidth('lg'),
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
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.transactions');
    }
}
