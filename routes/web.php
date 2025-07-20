<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WalletController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    Mail::raw('Test email content', function ($message) {
        $message->to('davefast2003@gmail.com')
                ->subject('Test Email');
    });

    return 'Email sent';
});

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
    // Dashboard Summary
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // My Events (created by me)
    Route::get('/dashboard/my-events', [DashboardController::class, 'myEvents'])->name('dashboard.my-events');

    // Single event detail inside dashboard
    Route::get('/dashboard/my-events/{event}', [DashboardController::class, 'showEvent'])->name('dashboard.event-details');

    // view attendees for my event
    Route::get('/dashboard/my-events/{event}/attendees', [EventController::class, 'attendees'])
        ->name('dashboard.event-attendees');

    // Create Event (from dashboard)
    Route::get('/dashboard/create-event', [DashboardController::class, 'createEvent'])->name('dashboard.create-event');

    // Show form to edit event
    Route::get('/dashboard/my-events/{event}/edit', [DashboardController::class, 'editEvent'])
        ->name('dashboard.edit-event');

    // Chackout page to register for event
    Route::get('/checkout/{event}', [EventController::class, 'checkout'])->name('dashboard.checkout');


    // route to show tickets
    Route::get('/dashboard/my-tickets', [TicketController::class, 'index'])->name('dashboard.ticket');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('dashboard.show-ticket');
    Route::get('/tickets/{ticket}/download', [TicketController::class, 'download'])->name('dashboard.download-ticket');


    // My Wallet
    Route::get('/dashboard/wallet', [WalletController::class, 'show'])->name('dashboard.wallet');
    Route::get('/dashboard/wallet/fund', [WalletController::class, 'showFundForm'])->name('wallet.fund');
    Route::post('/dashboard/wallet/fund', [WalletController::class, 'processFund'])->name('wallet.fund.submit');

    // Profile Settings
    Route::get('/dashboard/profile-settings', [ProfileController::class, 'edit'])->name('dashboard.profile-settings');
    Route::patch('/dashboard/profile-settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/dashboard/profile-settings', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // My Tickets (events I registered for)
    // Route::get('/my-tickets', [TicketController::class, 'index'])->name('tickets.index');
    // Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
