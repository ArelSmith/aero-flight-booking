<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
