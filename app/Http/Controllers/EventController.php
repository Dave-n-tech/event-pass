<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Basic search by title, location, or category
        if ($request->filled('query')) {
            $search = $request->query('query');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        // Filters
        if ($request->filled('date')) {
            $query->whereDate('event_date', $request->query('date'));
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->query('location')}%");
        }

        if ($request->filled('category')) {
            $query->where('category', $request->query('category'));
        }

        if ($request->filled('price')) {
            $price = $request->query('price');
            if ($price === 'free') {
                $query->where('price', 0);
            } elseif ($price === 'paid') {
                $query->where('price', '>', 0);
            } elseif ($price === '0-25') {
                $query->whereBetween('price', [0, 25]);
            } elseif ($price === '25-50') {
                $query->whereBetween('price', [25, 50]);
            } elseif ($price === '50-100') {
                $query->whereBetween('price', [50, 100]);
            } elseif ($price === '100+') {
                $query->where('price', '>', 100);
            }
        }

        //show all events
        // $events = Event::latest()->paginate(8);
        $events = $query->orderBy('event_date', 'asc')->paginate(8);
        return view('landing', compact('events'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $user = Auth::user();
        $hasRegistered = false;

        if ($user) {
            $hasRegistered = $event->tickets()->where('user_id', $user->id)->exists();
        }

        return view('events.show', [
            'event' => $event,
            'hasRegistered' => $hasRegistered,
            'layout' => 'app'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('events.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'capacity' => 'nullable|integer|min:1',
            'event_date' => 'required|date',
            'price' => 'required|numeric|min:0',
        ]);

        Event::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image' => $request->file('image') ? $request->file('image')->store('images', 'public') : null,
            'capacity' => $request->capacity,
            'event_date' => $request->event_date,
            'price' => $request->price,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'capacity' => 'nullable|integer|min:1',
            'event_date' => 'required|date',
            'price' => 'required|numeric|min:0',
        ]);

        $event->update($request->only('title', 'description', 'location', 'image', 'capacity', 'event_date', 'price'));

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    public function attendees(Event $event)
    {
        $this->authorize('view', $event);

        $attendees = $event->tickets()->with('user')->get();

        return view('events.attendees', compact('event', 'attendees'));
    }
}
