<?php

namespace App\Livewire\Admin;

use App\Models\Result;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\UserPayment;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Actions;

class Results extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Result::query())
            ->columns([
                TextColumn::make('user.userDetails.FullName')->searchable()->label('Full Name'),
                TextColumn::make('created_at')->label('Date Added')->dateTime(),
                TextColumn::make('userPayment.status')->label('Status'),
                TextColumn::make('result')->html(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Actions\Action::make('view_result')
                ->label("View Result")
                ->icon('heroicon-s-eye')
                ->button()
                ->color('success')
                ->url(fn (Result $record): string => route('user.transaction-result', $record->userPayment->id)),
                Actions\Action::make('print_result')
                ->label("Print Result")
                ->icon('heroicon-s-printer')
                ->button()
                ->color('success')
                ->url(fn (Result $record): string => route('admin.result-report', $record->id)),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.results');
    }
}
