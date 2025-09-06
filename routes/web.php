<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/flights', [FlightController::class, 'index'])->name('flight.index');
Route::get('/flights/{flightNumber}/choose-tier', [FlightController::class, 'show'])->name('flight.show');

Route::get('/flights/booking/{flightNumber}', [BookingController::class, 'booking'])->name('booking');

Route::get('/flights/booking/{flightNumber}/choose-seat', [BookingController::class, 'chooseSeat'])->name('booking.chooseSeat');
Route::post('/flights/booking/{flightNumber}/confirm-seat', [BookingController::class, 'confirmSeat'])->name('booking.confirmSeat');

Route::get('/flights/booking/{flightNumber}/passenger-details', [BookingController::class, 'passengerDetails'])->name('booking.passengerDetails');
Route::post('/flights/booking/{flightNumber}/save-passenger-details', [BookingController::class, 'savePassengerDetails'])->name('booking.savePassengerDetails');

Route::get('/flights/booking/{flightNumber}/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
Route::post('/flights/booking/{flightNumber}/payment', [BookingController::class, 'payment'])->name('booking.payment');

Route::get('/booking-success', [BookingController::class, 'success'])->name('booking.success');

Route::get('/check-booking', [BookingController::class, 'checkBooking'])->name('booking.check');
Route::post('/check-booking', [BookingController::class, 'show'])->name('booking.show');