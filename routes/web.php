<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/order', function () {
    return view('pages.order.order');
})->middleware(['auth', 'verified'])->name('order');

Route::get('/service', function () {
    return view('pages.service.service');
})->middleware(['auth', 'verified'])->name('service');

Route::get('/customer', function () {
    return view('pages.customer.customer');
})->middleware(['auth', 'verified'])->name('customer');

Route::get('/users', function () {
    return view('pages.users.users');
})->middleware(['auth', 'verified'])->name('users');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
