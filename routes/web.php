<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\PasswordController as AdminPasswordController;

// GENERAL PAGES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/terms-and-conditions', [HomeController::class, 'terms'])->name('terms-and-conditions');

// CARS
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/search', [CarController::class, 'search'])->name('cars.search');
Route::get('/cars/{car}/book', [CarController::class, 'book'])->name('cars.book');
Route::get('/cars/{car}/json-book', [CarController::class, 'jsonBook'])->name('cars.book.json');
Route::post('/cars/{car}/book', [CarController::class, 'storeBooking'])->name('cars.book.store');
Route::get('/reservations/{reservation}', [ReservationController::class, 'showForClient'])->name('reservations.show');

// RESERVATIONS
Route::get('/reservations/{reservation}/print', [ReservationController::class,'print'])
    ->name('reservations.print');

// ADMIN
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/forgot-password', [AdminPasswordController::class, 'showForgotPassword'])->name('admin.password.request');
    Route::post('/forgot-password', [AdminPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('/reset-password/{token}', [AdminPasswordController::class, 'showResetPassword'])->name('admin.password.reset');
    Route::post('/reset-password', [AdminPasswordController::class, 'resetPassword'])->name('admin.password.update');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/change-password', [AdminPasswordController::class, 'showChangePassword'])->name('admin.password.change');
        Route::post('/change-password', [AdminPasswordController::class, 'updatePassword'])->name('admin.password.change.update');

        Route::get('/cars', [AdminCarController::class, 'index'])->name('admin.cars.index');
        Route::get('/cars/create', [AdminCarController::class, 'create'])->name('admin.cars.create');
        Route::post('/cars', [AdminCarController::class, 'store'])->name('admin.cars.store');
        Route::get('/cars/{car}', [AdminCarController::class, 'show'])->name('admin.cars.show');
        Route::get('/cars/{car}/edit', [AdminCarController::class, 'edit'])->name('admin.cars.edit');
        Route::put('/cars/{car}', [AdminCarController::class, 'update'])->name('admin.cars.update');
        Route::delete('/cars/{car}', [AdminCarController::class, 'destroy'])->name('admin.cars.destroy');

        Route::get('/reservations', [ReservationController::class, 'index'])->name('admin.reservations.index');
        Route::get('/reservations/create', [ReservationController::class, 'create'])->name('admin.reservations.create');
        Route::post('/reservations/store', [ReservationController::class, 'store'])->name('admin.reservations.store');
        Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('admin.reservations.show');
        Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('admin.reservations.edit');
        Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('admin.reservations.update');
        Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('admin.reservations.destroy');

        Route::get('/ajax/cars/{car}/config', [ReservationController::class, 'carConfig'])
            ->name('ajax.car.config');

        Route::get('/reservations/{reservation}/print', [ReservationController::class,'print'])
            ->name('admin.reservations.print');
    });
});