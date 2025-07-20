@extends('layouts.dashboard')

@section('content')
    <div class="max-w-5xl mx-auto py-8 px-2" x-data="{ tab: 'myTickets' }">
        <h2 class="text-2xl font-bold mb-6 text-center">Your Tickets</h2>

        <!-- Tabs -->
        <div class="flex space-x-4 justify-center mb-6">
            <button @click="tab = 'myTickets'"
                :class="tab === 'myTickets' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                My Tickets
            </button>
            <button @click="tab = 'ticketsSold'"
                :class="tab === 'ticketsSold' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                Tickets Sold
            </button>
        </div>

        <!-- My Tickets -->
        <div x-show="tab === 'myTickets'" class="space-y-4">
            @forelse($myTickets as $ticket)
                <div class="bg-white p-4 rounded-lg shadow-sm border">
                    <h3 class="text-lg font-semibold">{{ $ticket->event->title }}</h3>
                    <p class="text-sm mt-1">Ticket Code: <span
                            class="font-mono text-gray-700">{{ $ticket->ticket_code ? $ticket->ticket_code : $ticket->id }}</span></p>
                    <p class="text-xs text-gray-500">Purchased: {{ $ticket->created_at->format('d M Y, h:i A') }}</p>

                    <div class="flex space-x-3 my-4">
                        <a href="{{ route('dashboard.show-ticket', $ticket->id) }}"
                            class="px-4 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            View Details
                        </a>
                        <a href="{{ route('dashboard.download-ticket', $ticket->id) }}"
                            class="px-4 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700 transition">
                            Download
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500">You haven't bought any tickets yet.</div>
            @endforelse
        </div>

        <!-- Tickets Sold -->
        <div x-show="tab === 'ticketsSold'" x-cloak class="space-y-4">
            @forelse($ticketsSold as $ticket)
                <div class="bg-white p-4 rounded-lg shadow-sm border">
                    <h3 class="text-lg font-semibold">{{ $ticket->event->title }}</h3>
                    <p class="text-sm mt-1">Sold To: <span class="text-gray-700">{{ $ticket->user->name }}
                            ({{ $ticket->user->email }})
                        </span></p>
                    <p class="text-sm">Ticket Code: <span class="font-mono text-gray-700">{{ $ticket->ticket_code }}</span>
                    </p>
                    <p class="text-xs text-gray-500">Sold: {{ $ticket->created_at->format('d M Y, h:i A') }}</p>
                </div>
            @empty
                <div class="text-center text-gray-500">No tickets have been sold yet for your events.</div>
            @endforelse
        </div>
    </div>
@endsection
