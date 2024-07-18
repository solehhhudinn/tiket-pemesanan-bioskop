<?php

use App\Http\Controllers\Admin\AdminIklanController;
use App\Http\Controllers\Admin\AdminMovieController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminTheaterController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Admin\AdminSeatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SeatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('movies', AdminMovieController::class);
    Route::resource('iklans', AdminIklanController::class);
    Route::resource('theaters', AdminTheaterController::class);
    Route::resource('schedules', AdminScheduleController::class);
    Route::resource('seats', AdminSeatController::class);
    Route::resource('payments', AdminPaymentController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

Route::middleware('web')->group(function () {
    Route::get('/', [MovieController::class, 'index'])->name('home');
    Route::get('/now-playing', [MovieController::class, 'nowPlaying'])->name('movies.nowPlaying');
    Route::get('/upcoming', [MovieController::class, 'upcoming'])->name('movies.upcoming');
    Route::get('/theaters', [TheaterController::class, 'index'])->name('theaters.index');
    Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
    Route::get('/movies/{movie}/trailer', [MovieController::class, 'trailer'])->name('movies.trailer');
    Route::get('/movies/{movie}/tickets', [TicketController::class, 'index'])->name('movies.tickets');
});

Route::middleware('auth')->group(function () {
    Route::get('/tickets/{id}/seatSelection', [TicketController::class, 'seatSelection'])->name('tickets.seatSelection');
    Route::get('/api/theaters/{theater}/seats', [SeatController::class, 'getSeats']);
    Route::post('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment/barcode', [PaymentController::class, 'showBarcode'])->name('payment.barcode');
    Route::post('/upload-bukti-pembayaran', [PaymentController::class, 'uploadBuktiPembayaran'])->name('upload.bukti.pembayaran');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::post('notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});

