<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Event Ticket Booking Application
|--------------------------------------------------------------------------
*/

// 1-Page Main Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Booking Flow
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Ticket History & E-Ticket Display
Route::get('/my-tickets', [TicketController::class, 'myTickets'])->name('tickets.my');
Route::get('/tickets/lookup', [TicketController::class, 'lookup'])->name('tickets.lookup');
Route::post('/tickets/lookup', [TicketController::class, 'lookup'])->name('tickets.lookup.submit');
Route::get('/tickets/{bookingCode}', [TicketController::class, 'show'])->name('tickets.show');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/check-in/{id}', [AdminController::class, 'toggleCheckIn'])->name('checkin');
});
