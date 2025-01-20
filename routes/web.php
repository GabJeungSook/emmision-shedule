<?php

use App\Livewire\Admin\Users;
use App\Livewire\Admin\Calendar;
use App\Livewire\Admin\Transactions;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CreateSchedule;
use App\Http\Controllers\ProfileController;

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
Route::get('/admin/create-schedule', CreateSchedule::class)->middleware(['auth', 'verified'])->name('admin.create-schedule')->where('date', '[0-9\-]+');
require __DIR__.'/auth.php';
