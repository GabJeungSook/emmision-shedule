<?php

use App\Models\Application;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Calendar;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\UserReport;
use App\Livewire\Admin\VehicleType;
use App\Livewire\User\Applications;
use App\Livewire\Admin\Transactions;
use App\Livewire\Admin\ViewSchedule;
use App\Livewire\Admin\AddResult;
use App\Livewire\User\UserDashboard;
use Illuminate\Support\Facades\Auth;
use App\Livewire\User\MyTransactions;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CreateSchedule;
use App\Livewire\User\ViewTransaction;
use App\Livewire\User\CreateTransaction;
use App\Livewire\User\ManageAppointment;
use App\Livewire\Admin\TransactionReport;
use App\Livewire\Admin\UserApplications;
use App\Livewire\Admin\ScanQrCode;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\AllReports;
use App\Livewire\Admin\ResultReport;
use App\Livewire\Admin\Results;
use App\Livewire\User\ViewApplication;
use App\Livewire\User\ViewAvailableSchedules;
use App\Livewire\User\CreatePayment;
use App\Livewire\User\TransactionResult;
use App\Livewire\User\UserTransactionDetails;
use App\Livewire\User\UserReceipt;
use App\Livewire\User\UserQrCode;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
   if (Auth::user()->role === 'admin') {
       return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::get('/admin/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('admin.dashboard');
Route::get('/admin/users', Users::class)->middleware(['auth', 'verified'])->name('admin.users');
Route::get('/admin/applications', UserApplications::class)->middleware(['auth', 'verified'])->name('admin.applications');
Route::get('/admin/calendar', Calendar::class)->middleware(['auth', 'verified'])->name('admin.calendar');
Route::get('/admin/transactions', Transactions::class)->middleware(['auth', 'verified'])->name('admin.transactions');
Route::get('/admin/vehicle-type', VehicleType::class)->middleware(['auth', 'verified'])->name('admin.vehicle-type');
Route::get('/admin/create-schedule', CreateSchedule::class)->middleware(['auth', 'verified'])->name('admin.create-schedule')->where('date', '[0-9\-]+');
Route::get('/admin/view-schedule/{record}', ViewSchedule::class)->middleware(['auth', 'verified'])->name('admin.view-schedule');
Route::get('/admin/user-report', UserReport::class)->middleware(['auth', 'verified'])->name('admin.user-report');
Route::get('/admin/transaction-report', TransactionReport::class)->middleware(['auth', 'verified'])->name('admin.transaction-report');
Route::get('/admin/add-result/{record}', AddResult::class)->middleware(['auth', 'verified'])->name('admin.add-result');
Route::get('/admin/scan-qr', ScanQrCode::class)->middleware(['auth', 'verified'])->name('admin.scan-qr');
Route::get('/admin/results', Results::class)->middleware(['auth', 'verified'])->name('admin.results');
Route::get('/admin/result-report/{record}', ResultReport::class)->middleware(['auth', 'verified'])->name('admin.result-report');
Route::get('/admin/all-result-report', AllReports::class)->middleware(['auth', 'verified'])->name('admin.all-result-report');

Route::get('/user/dashboard', UserDashboard::class)->middleware(['auth', 'verified'])->name('user.dashboard');
Route::get('/user/view-transaction', ViewTransaction::class)->middleware(['auth', 'verified'])->name('user.view-transaction');
Route::get('/user/create-transaction/{record}', CreateTransaction::class)->middleware(['auth', 'verified'])->name('user.create-transaction');
Route::get('/user/view-schedules', ViewAvailableSchedules::class)->middleware(['auth', 'verified'])->name('user.view-schedules');
Route::get('/user/applications', Applications::class)->middleware(['auth', 'verified'])->name('user.applications');
Route::get('/user/view-application/{record}', ViewApplication::class)->middleware(['auth', 'verified'])->name('user.view-application');
Route::get('/user/my-transactions', MyTransactions::class)->middleware(['auth', 'verified'])->name('user.my-transactions');
Route::get('/user/user-payment/{record}', CreatePayment::class)->middleware(['auth', 'verified'])->name('user.user-payment');
Route::get('/user/transaction-details/{record}', UserTransactionDetails::class)->middleware(['auth', 'verified'])->name('user.transaction-details');
Route::get('/user/user-receipt/{record}', UserReceipt::class)->middleware(['auth', 'verified'])->name('user.user-receipt');
Route::get('/user/user-qr-code/{record}', UserQrCode::class)->middleware(['auth', 'verified'])->name('user.user-qr-code');
Route::get('/user/transaction-result/{record}', TransactionResult::class)->middleware(['auth', 'verified'])->name('user.transaction-result');

require __DIR__.'/auth.php';
