<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
Route::get('dashboard',[DashboardController::class,'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

// Route::view('dashboard.nuevo','dashboard.nuevo')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard.nuevo');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php'; 
