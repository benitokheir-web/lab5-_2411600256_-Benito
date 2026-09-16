<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('products', ProductController::class);

    Route::get('/transactions', [InventoryTransactionController::class, 'index'])
        ->name('transactions.index');

    Route::get('/transactions/{type}/create', [InventoryTransactionController::class, 'create'])
        ->whereIn('type', ['in', 'out'])
        ->name('transactions.create');

    Route::post('/transactions/{type}', [InventoryTransactionController::class, 'store'])
        ->whereIn('type', ['in', 'out'])
        ->name('transactions.store');

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');
});
