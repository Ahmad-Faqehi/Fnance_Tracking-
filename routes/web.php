<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\CustomUser;
use App\Http\Controllers\ItemController;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::get('/brands', [BrandController::class, 'index'])->name('brands');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/sms', [SmsController::class, 'index'])->name('sms');


    Route::get('/item', [ItemController::class, 'index'])->name('itemview');
    Route::get('/delete/{id}', [ItemController::class, 'delete'])->name('itemdelete');

    Route::post('/item', [ItemController::class, 'store'])->name('item');
    Route::patch('/item', [ItemController::class, 'update'])->name('itemupdate');

    // Route::post('itemcreare', [ItemController::class, 'store'])->name('item');


    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    
    Route::get('/home', function () {
        return view('home');
    });
    
    Route::get('/register', function () {
        return view('register');
    });


    // Route::post('/register', 'CustomUser@store');
    Route::post('register', [CustomUser::class, 'store'])->name('register');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});