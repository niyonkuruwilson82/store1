<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route (Protected by 'auth' and 'verified' middleware)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile Routes (Edit, Update, and Delete Profile)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('productin/{productin}/edit', [ProductInController::class, 'edit'])->name('productin.edit');

    // Product Routes (CRUD for Product and ProductIn)
    Route::get('productin/{productin}/edit', [ProductInController::class, 'edit'])->name('productin.edit');
    Route::resource('products', ProductController::class);
    Route::resource('productin', ProductInController::class); // Resource route already includes edit and update



});

// Default Authentication Routes (Login, Register, etc.)
require __DIR__ . '/auth.php';
// Route::get('/productin', [ProductInController::class, 'index'])->name('productin.index');