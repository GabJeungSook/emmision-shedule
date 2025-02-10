<?php

namespace App\Livewire\Admin;

use App\Models\Vehicle;
use Livewire\Component;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class VehicleType extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Vehicle::query())
            ->columns([
                TextColumn::make('name')->searchable()->label('Type'),
                TextColumn::make('amount')->sortable(),
            ])
            ->filters([
                // ...
            ])
            ->headerActions([
                // CreateAction::make()
                // ->model(Vehicle::class)
                // ->form([
                //     TextInput::make('name')
                //         ->required()
                //         ->maxLength(255),
                //     TextInput::make('amount')
                //         ->required()
                //         ->numeric()
                //         ->maxLength(255),
                // ])
            ])
            ->actions([
                EditAction::make('edit')
                ->color('success')
                ->button()
                ->fillForm(function(Model $record) {
                    return [
                        'name' => $record->name,
                        'amount' => $record->amount,
                    ];
                })
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('amount')
                        ->required()
                        ->maxLength(255),
                ]),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.vehicle-type');
    }
}
