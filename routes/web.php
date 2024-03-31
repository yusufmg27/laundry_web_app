<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\CreateServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/order', function () {
    return view('pages.order.order');
})->middleware(['auth', 'verified'])->name('order');

Route::get('/customer', function () {
    return view('pages.customer.customer');
})->middleware(['auth', 'verified'])->name('customer');

Route::middleware('auth')->group(function () {
    Route::get('users', [CreateUserController::class, 'index'])
    ->name('users.index');
    Route::get('/users/create-users', [CreateUserController::class, 'create'])
    ->name('create.users');
    Route::post('/users/create-users', [CreateUserController::class, 'store']);
    Route::get('users/edit', [CreateUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [CreateUserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy', [CreateUserController::class, 'destroy'])->name('users.destroy');

    Route::get('service', [CreateServiceController::class, 'index'])
    ->name('service.index');
    Route::get('/service/create-service', [CreateServiceController::class, 'create'])
    ->name('create.service');
    Route::post('/service/create-service', [CreateServiceController::class, 'store']);
    Route::get('service/edit', [CreateServiceController::class, 'edit'])->name('service.edit');
    Route::put('/service/{id}', [CreateServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/destroy', [CreateServiceController::class, 'destroy'])->name('service.destroy');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
