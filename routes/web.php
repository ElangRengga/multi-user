<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

use App\Http\Controllers\auth\RegisteredUserController;
use App\Http\Controllers\ActivityController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/activities/history', [ActivityController::class, 'history'])->name('activities.history');

Route::middleware('auth')->group(function () {
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::post('/activities/checkout', [ActivityController::class, 'checkout'])->name('activities.checkout');
    Route::resource('items', ItemController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});


require __DIR__ . '/auth.php';
