<?php

use App\Livewire\Admin\Users;
use App\Livewire\Admin\Calendar;
use App\Livewire\Admin\Transactions;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CreateSchedule;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\VehicleType;
use App\Livewire\Admin\ViewSchedule;
use App\Livewire\User\CreateTransaction;
use App\Livewire\User\ViewAvailableSchedules;
use App\Livewire\User\ViewTransaction;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/admin/users', Users::class)->middleware(['auth', 'verified'])->name('admin.users');
Route::get('/admin/calendar', Calendar::class)->middleware(['auth', 'verified'])->name('admin.calendar');
Route::get('/admin/transactions', Transactions::class)->middleware(['auth', 'verified'])->name('admin.transactions');
Route::get('/admin/vehicle-type', VehicleType::class)->middleware(['auth', 'verified'])->name('admin.vehicle-type');
Route::get('/admin/create-schedule', CreateSchedule::class)->middleware(['auth', 'verified'])->name('admin.create-schedule')->where('date', '[0-9\-]+');
Route::get('/admin/view-schedule/{record}', ViewSchedule::class)->middleware(['auth', 'verified'])->name('admin.view-schedule');

Route::get('/user/view-transaction', ViewTransaction::class)->middleware(['auth', 'verified'])->name('user.view-transaction');
Route::get('/user/create-transaction/{record}', CreateTransaction::class)->middleware(['auth', 'verified'])->name('user.create-transaction');
Route::get('/user/view-schedules', ViewAvailableSchedules::class)->middleware(['auth', 'verified'])->name('user.view-schedules');
require __DIR__.'/auth.php';
