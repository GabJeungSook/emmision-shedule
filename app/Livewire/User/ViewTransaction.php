<?php

namespace App\Livewire\User;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\Transaction as TransactionModel;
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

class ViewTransaction extends Component implements HasForms
{
    // use InteractsWithTable;
    use InteractsWithForms;
    public $transactions;

    public function mount()
    {
        $this->transactions = UserPayment::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    }

    // public function table(Table $table): Table
    // {
    //     return $table
    //         ->query(UserPayment::query()->where('user_id', Auth::user()->id))
    //         ->columns([
    //             TextColumn::make('transaction_number')->searchable()->label('Transaction Number'),
    //             TextColumn::make('application.schedule.date')->label('Schedule Date')->date('F j, Y'),
    //             TextColumn::make('application.convertHour')->label('Time'),
    //             TextColumn::make('payment_method')->label('Payment Method')->formatStateUsing(fn (?string $state) => strtoupper($state)),
    //             TextColumn::make('vehicle.name')->label('Vehicle'),
    //             TextColumn::make('vehicle.amount')->label('Amount')->formatStateUsing(fn (?string $state) => '₱ '.number_format($state, 2)),
    //         ])
    //         ->filters([
    //             // ...
    //         ])
    //         ->actions([
    //             Tables\Actions\Action::make('View')
    //             ->icon('heroicon-s-eye')
    //             ->button()
    //             ->color('success')
    //             ->modalHeading('Transaction QR Code')
    //             ->modalSubmitAction(false)
    //             ->modalContent(function (Model $record) {
    //                 return view('user.qr-code', ['record' => $record]);
    //             })
    //             ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
    //             ->closeModalByClickingAway(false)->modalWidth('lg'),
    //             Tables\Actions\Action::make('View Receipt')
    //             ->icon('heroicon-s-eye')
    //             ->button()
    //             ->color('success')
    //             ->modalHeading('Receipt')
    //             ->modalSubmitAction(false)
    //             ->modalContent(function (Model $record) {
    //                 return view('user.receipt', ['record' => $record]);
    //             })
    //             ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
    //             ->closeModalByClickingAway(false)->modalWidth('lg'),
    //         ])
    //         ->bulkActions([
    //             // ...
    //         ]);
    // }

    public function render()
    {
        return view('livewire.user.view-transaction');
    }
}
