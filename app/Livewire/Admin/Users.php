<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;

class Users extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->where('role', 'user'))
            ->columns([
                TextColumn::make('username')->searchable()->label('Username'),
                TextColumn::make('userDetails.FullName')->label('Full Name'),
                TextColumn::make('created_at')->label('Date Created')->dateTime()
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
        return view('livewire.admin.users');
    }
}
