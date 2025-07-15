<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketRegistered;

class TicketController extends Controller
{
    // show all tickets for the authenticated user
    public function index(Request $request)
    {
        $tickets = $request->user()->tickets()->with('event')->get();
        return view('tickets.index', compact('tickets'));
    }

    // show a specific ticket
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    // create a new ticket for an event
    public function store(Event $event)
    {
        $user = Auth::user();

        // Prevent duplicate registrations
        if ($event->tickets()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You have already registered for this event.');
        }

        // Check if the event is full
        if ($event->capacity !== null && $event->tickets()->count() >= $event->capacity) {
            return back()->with('error', 'This event is full. You cannot register.');
        }

        // Create ticket
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'user-email' => $user->email,
            'quantity' => 1
        ]);

        // Generate QR code for the ticket
        $qrData = "TICKET_ID:{$ticket->id}|USER:{$user->email}|EVENT:{$event->title}";
        $qrPath = 'qrcodes/ticket_' . $ticket->id . '.svg';

        QrCode::format('svg')->size(200)->generate($qrData, public_path($qrPath));

        // Update ticket with QR code path
        $ticket->qr_code = $qrPath;
        $ticket->save();

        // Send email with ticket
        Mail::to($user->email)->queue(new TicketRegistered($ticket));


        return back()->with('success', 'You have registered! Your ticket QR code is ready.');
    }
}
