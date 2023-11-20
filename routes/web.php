<?php

use App\Http\Controllers\Admin\EpinController;
use App\Http\Controllers\Admin\EpinTransferController;
use App\Http\Controllers\Admin\TransactionHistoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WithdrawController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\EpinController as UserEpinController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\UserController as UserUserController;
use App\Http\Controllers\User\UserReportController;
use App\Http\Controllers\User\WithdrawlHistoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('server-commands')->group(function () {
    Route::get('optimize', function () {
        \Artisan::call('optimize');
        dd("Done!");
    });
});

Route::any('/', function () {
    return to_route('login');
});

Auth::routes();

Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::put('walletTransfer/{user}', [UserController::class, 'walletTransfer'])->name('walletTransfer');
    Route::resource('epin', EpinController::class)->only('index', 'create', 'store');
    Route::resource('transfer', EpinTransferController::class)->only('index', 'edit', 'update')->parameter('transfer', 'user');
    Route::resource('transactionHistory', TransactionHistoryController::class)->only('index');
    Route::get('withdrawRequest', [WithdrawController::class, 'index'])->name('withdrawRequest');
    Route::get('withdrawUser', [WithdrawController::class, 'userdetails'])->name('withdrawUser');
    Route::post('withdrawUserstore', [WithdrawController::class, 'store'])->name('withdrawlstore');
    Route::get('withdrawAccept', [WithdrawController::class, 'useraccept'])->name('withdrawAccept');
    Route::get('withdrawReject', [WithdrawController::class, 'userreject'])->name('withdrawReject');
    Route::get('transfer-report', [AdminReportController::class, 'transfer'])->name('report.transfer');
    Route::get('accept-report', [AdminReportController::class, 'accept'])->name('report.accept');
    Route::get('member-report', [AdminReportController::class, 'member'])->name('report.member');
    Route::get('request-report', [AdminReportController::class, 'request_report'])->name('report.request');
    Route::get('reject-report', [AdminReportController::class, 'reject'])->name('report.reject');
});
Route::get('userdetails', [UserEpinController::class, 'userdetails'])->name('userdetails');
Route::get('userLogin', [LoginController::class, 'login'])->name('userLogin');
Route::post('loggedin', [LoginController::class, 'loggedin'])->name('loggedin');
Route::prefix('user')->as('user.')->middleware(['auth'])->group(function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::resource('epin', UserEpinController::class);
    Route::put('epinRegister/{epin}', [UserEpinController::class, 'updateEpinWithRegister'])->name('epinRegister');
    Route::resource('user', UserUserController::class);
    Route::put('updateAccountDetails/{user}', [WithdrawlHistoryController::class, 'updateAccountDeatils'])->name('updateAccountDetails');
    Route::resource('withdrawl', WithdrawlHistoryController::class)->parameter('withdrawl', 'withdrawlHistory');
    Route::get('tree', [UserUserController::class, 'tree'])->name('tree');
    Route::get('accept-report', [UserReportController::class, 'accept'])->name('report.accept');
    Route::get('reject-report', [UserReportController::class, 'reject'])->name('report.reject');
    Route::get('change-password', [LoginController::class, 'changepassword'])->name('change-password');
    Route::post('change-password-store', [LoginController::class, 'changepassword_store'])->name('change-password.store');
    Route::get('userlogout', [LoginController::class, 'userlogout'])->name('userlogout');
});
