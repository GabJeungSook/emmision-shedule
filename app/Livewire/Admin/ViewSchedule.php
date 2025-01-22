<?php

namespace App\Livewire\Admin;

use App\Models\Schedule;
use App\Models\Transaction;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;

class ViewSchedule extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $record;

    public function mount($record)
    {
        $this->record = Schedule::find($record);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Transaction::query()->where('schedule_id', $this->record->id))
            ->columns([
                TextColumn::make('transaction_number')->label('Transaction Number'),
                 TextColumn::make('user.userDetails.FullName')->searchable()->label('Full Name'),
                 TextColumn::make('schedule.date')->label('Date')->date('F j, Y'),
                 TextColumn::make('convertHour')->label('Schedule'),
                 TextColumn::make('vehicle.name')->label('Vehicle'),
                 TextColumn::make('vehicle.amount')->label('Amount')->formatStateUsing(fn (?string $state) => '₱ '.number_format($state, 2))
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.view-schedule');
    }
}
