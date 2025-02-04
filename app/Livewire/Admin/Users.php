<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\UserDetail;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

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
                EditAction::make('edit')
                ->label('Edit User Details')
                ->color('success')
                ->button()
                ->fillForm(function(Model $record) {
                    return [
                        'first_name' => $record->userDetails->first_name,
                        'last_name' => $record->userDetails->last_name,
                        'gender' => $record->userDetails->gender,
                        'address' => $record->userDetails->address,
                        'phone' => $record->userDetails->phone,
                        'email' => $record->userDetails->email,
                        'plate_number' => $record->userDetails->plate_number,
                    ];
                })
                ->using(function (Model $record, array $data): Model {
                    $record->userDetails()->update($data);

                    return $record;
                })
                ->form([
                    TextInput::make('first_name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('last_name')
                        ->required()
                        ->maxLength(255),
                    Select::make('gender')
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female'
                        ])
                        ->required(),
                    Textarea::make('address')
                        ->required(),
                    TextInput::make('phone')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->required()
                        ->email()
                        ->maxLength(255),
                    TextInput::make('plate_number')
                        ->required()
                        ->maxLength(255),
                ]),
                EditAction::make('edit_user')
                ->label('Edit User Account')
                ->color('warning')
                ->button()
                ->fillForm(function(Model $record) {
                    return [
                        'username' => $record->username,
                    ];
                })
                ->form([
                    TextInput::make('username')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('password')
                        ->password()
                        ->confirmed()
                        ->revealable()
                        ->required(),
                    TextInput::make('password_confirmation')
                        ->label('Confirm Password')
                        ->password()
                        ->revealable()
                        ->required()
                ]),
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
