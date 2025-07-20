<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketRegistered;
use App\Models\WalletTransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class TicketController extends Controller
{
    use AuthorizesRequests;

    // show all tickets for the authenticated user
    public function index(Request $request)
    {
        $user = Auth::user();

        // My Tickets
        $myTickets = Ticket::with('event')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Tickets Sold
        $myEvents = Event::where('user_id', $user->id)->pluck('id');
        $ticketsSold = Ticket::with('user', 'event')
            ->whereIn('event_id', $myEvents)
            ->latest()
            ->get();

        return view('dashboard.my-tickets', compact('myTickets', 'ticketsSold'));
    }

    // show a specific ticket
    public function show(Ticket $ticket)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, "Forbidden");
        }

        return view('dashboard.show-ticket', compact('ticket'));
    }

    public function download(Ticket $ticket)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, "Forbidden");
        }

        $ticket = Ticket::with('event', 'user')->findOrFail($ticket->id);

        if (!$ticket->qr_code || !Storage::disk('public')->exists($ticket->qr_code)) {
            $qrCode = new QrCode($ticket->ticket_code);
            $qrCode->setSize(300);
            $qrCode->setMargin(10);

            $writer = new PngWriter();
            $qrImage = $writer->write($qrCode);

            $fileName = 'qrcodes/' . $ticket->ticket_code . '.png';
            Storage::disk('public')->put($fileName, $qrImage->getString());

            $ticket->qr_code = $fileName;
            $ticket->save();
        }

        $pdf = Pdf::loadView('tickets.pdf', compact('ticket'));

        return $pdf->download("Ticket-{$ticket->id}.pdf");
    }

    // create a new ticket for an event
    public function store(Request $request, Event $event)
    {
        $user = Auth::user();
        $wallet = $user->wallet;

        if (!$user) {
            abort(403, 'Forbidden');
        }

        // Prevent duplicate registrations
        if ($event->tickets()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You have already registered for this event.');
        }

        // Check if the event is full
        if ($event->capacity !== null && $event->tickets()->count() >= $event->capacity) {
            return back()->with('error', 'This event is full. You cannot register.');
        }

        if ($wallet->balance < $event->price) {
            return back()->with('error', 'Insufficient wallet balance.');
        }

        // Deduct price
        $wallet->balance -= $event->price;
        $wallet->save();

        // Log wallet transaction
        WalletTransaction::create([
            'user_id' => $user->id,
            'type' => 'withdraw',
            'amount' => $event->price,
        ]);

        // Generate unique ticket code
        $ticketCode = strtoupper(uniqid('TICKET_'));

        // Create ticket
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'user_email' => $user->email,
            'quantity' => $request->quantity,
            'ticket_code' => $ticketCode
        ]);

        // Generate QR code for the ticket
        $qrCode = new QrCode($ticket->ticket_code);
        $qrCode->setSize(300);
        $qrCode->setMargin(10);

        $writer = new PngWriter();
        $qrImage = $writer->write($qrCode);

        // Update ticket with QR code path
        $fileName = 'qrcodes/' . $ticket->ticket_code . '.png';
        Storage::disk('public')->put($fileName, $qrImage->getString());

        $ticket->qr_code = $fileName;
        $ticket->save();

        // Send email with ticket
        Mail::to($user->email)->queue(new TicketRegistered($ticket));


        return redirect()->route('dashboard.event-details', $event)->with('success', 'You have registered! Your ticket QR code is ready.');
    }
}
