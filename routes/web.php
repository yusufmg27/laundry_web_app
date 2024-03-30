<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CreateUserController;
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

Route::middleware('auth')->group(function () {
    Route::get('users', [CreateUserController::class, 'index'])
    ->name('users.index');
    Route::get('users/edit', [CreateUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [CreateUserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy', [CreateUserController::class, 'destroy'])->name('users.destroy');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
