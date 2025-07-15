<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WalletController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage: browse/search events
Route::get('/', [EventController::class, 'index'])->name('events.index');

// View single event details
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// Store event (needs auth)
Route::post('/events', [EventController::class, 'store'])
    ->middleware('auth')
    ->name('events.store');

Route::put('/events/{event}', [EventController::class, 'update'])
    ->middleware('auth')
    ->name('events.update');

Route::delete('/events/{event}', [EventController::class, 'destroy'])
    ->middleware('auth')
    ->name('events.destroy');

// Register for event
Route::post('/events/{event}/register', [TicketController::class, 'store'])
    ->middleware('auth')
    ->name('tickets.store');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // ✅ Dashboard Summary
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ My Events (created by me)
    Route::get('/dashboard/my-events', [DashboardController::class, 'myEvents'])->name('dashboard.my-events');

    // ✅ Single event detail inside dashboard
    Route::get('/dashboard/my-events/{event}', [DashboardController::class, 'showEvent'])->name('dashboard.event-details');

    // viw attendees for my event
    Route::get('/dashboard/my-events/{event}/attendees', [EventController::class, 'attendees'])
        ->name('dashboard.event-attendees');

    // ✅ Create Event (from dashboard)
    Route::get('/dashboard/create-event', [DashboardController::class, 'createEvent'])->name('dashboard.create-event');

    // Show form to edit event
    Route::get('/dashboard/my-events/{event}/edit', [EventController::class, 'edit'])
        ->name('dashboard.edit-event');

    // ✅ My Wallet
    Route::get('/dashboard/wallet', [WalletController::class, 'index'])->name('dashboard.wallet');

    // ✅ Profile Settings
    Route::get('/dashboard/profile-settings', [ProfileController::class, 'edit'])->name('dashboard.profile-settings');
    Route::patch('/dashboard/profile-settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/dashboard/profile-settings', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ My Tickets (events I registered for)
    Route::get('/my-tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
