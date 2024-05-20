<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AutomaticPaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'auth'], function() {
    Route::resource('accounts', AccountController::class)->except(['edit', 'update']);
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/automatic-payments', [AutomaticPaymentController::class, 'index'])->name('automatic-payments.index');
    Route::post('/automatic-payments', [AutomaticPaymentController::class, 'store'])->name('automatic-payments.store');
});



require __DIR__ . '/auth.php';
