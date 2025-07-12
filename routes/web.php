<?php

use \App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('events', EventController::class)
    ->middleware(['auth']);

Route::post('events/{event}/register', [TicketController::class, 'store'])
    ->middleware(['auth'])
    ->name('tickets.store');

Route::get('/events/{event}/attendees', [EventController::class, 'attendees'])
    ->middleware('auth')
    ->name('events.attendees');

Route::get('/my-tickets', [TicketController::class, 'index'])
    ->middleware(['auth'])
    ->name('tickets.index');

Route::get('/tickets/{ticket}', [TicketController::class, 'show'])
    ->middleware(['auth'])
    ->name('tickets.show');

require __DIR__ . '/auth.php';
