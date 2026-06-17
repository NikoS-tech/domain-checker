<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/domains');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::resource('domains', DomainController::class);
    Route::resource('domains.checks', CheckController::class)->shallow()->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::post('checks/{check}/run', [CheckController::class, 'run'])->name('checks.run');
    Route::get('logs', [LogController::class, 'index'])->name('logs.index');
});
