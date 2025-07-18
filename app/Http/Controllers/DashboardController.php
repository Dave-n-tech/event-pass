<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Ticket;
use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = Auth::user();

        $totalEvents = Event::where('user_id', $user->id)->count();

        $ticketsSold = Ticket::whereHas('event', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        $totalRevenue = Event::where('user_id', $user->id)
            ->withCount('tickets')
            ->get()
            ->sum(function ($event) {
                return $event->price * $event->tickets_count;
            });

        $totalAttendees = Ticket::whereHas('event', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->distinct('user_id')->count('user_id');


        $stats = [
            [
                'id' => 1,
                'name' => 'Total Events Created',
                'value' => $totalEvents,
                'icon' => 'calendar-days',
                'change' => [
                    'value' => 0, // Add percentage logic if you want
                    'isPositive' => true
                ],
            ],
            [
                'id' => 2,
                'name' => 'Tickets Sold',
                'value' => $ticketsSold,
                'icon' => 'ticket',
                'change' => [
                    'value' => 0,
                    'isPositive' => true
                ],
            ],
            [
                'id' => 3,
                'name' => 'Total Revenue',
                'value' => '$' . number_format($totalRevenue, 2),
                'icon' => 'trending-up',
                'change' => [
                    'value' => 0,
                    'isPositive' => true
                ],
            ],
            [
                'id' => 4,
                'name' => 'Total Attendees',
                'value' => $totalAttendees,
                'icon' => 'users',
                'change' => [
                    'value' => 0,
                    'isPositive' => true
                ],
            ],
        ];

        $upcomingEvents = Event::whereHas('tickets', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereDate('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(5)
            ->get();

        $recentActivities = Ticket::where('user_id', $user->id)
            ->with('event')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($ticket) {
                return [
                    'type' => 'ticket_purchase',
                    'event' => $ticket->event->title,
                    'date' => $ticket->created_at->diffForHumans(),
                    'details' => "You purchased a ticket",
                ];
            });

        return view('dashboard.index', compact(
            'stats',
            'upcomingEvents',
            'recentActivities'
        ));
    }

    public function myEvents()
    {
        $userId = Auth::id();

        $createdEvents = Event::where('user_id', $userId)->latest()->paginate(8);

        $registeredEvents = Event::whereHas('tickets', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->orderBy('event_date', 'asc')->paginate(8);

        $allEvents = Event::orderBy('event_date', 'asc')->paginate(8);

        return view('dashboard.my-events', compact('createdEvents', 'registeredEvents', 'allEvents'));
    }

    public function showEvent(Event $event)
    {
        $user = Auth::user();

        if(!$user){
            abort(403, "Unauthorized");
        }

        $hasRegistered = $event->tickets()->where('user_id', $user->id)->exists();

        return view('events.show',  [
            'event' => $event,
            'hasRegistered' => $hasRegistered,
            'layout' => 'dashboard'
        ]);
    }

    public function createEvent(Event $event)
    {
        $this->authorize('create', $event);
        return view('dashboard.create-event', compact('event'));
    }

    public function editEvent(Event $event)
    {
        $this->authorize('update', $event);
        return view('dashboard.edit-event', compact('event'));
    }
}
