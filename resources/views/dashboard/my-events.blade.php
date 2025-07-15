@extends('layouts.dashboard')

@section('content')
    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Heading -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">My Events</h1>
            <a href="{{ route('dashboard.create-event') }}"
                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create Event
            </a>
        </div>

        <!-- Events Created By You -->
        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Events You Created</h2>
            @if ($createdEvents->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($createdEvents as $event)
                        @include('dashboard.partials.event-card', ['event' => $event])
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $createdEvents->links() }}
                </div>
            @else
                <p class="text-gray-500">You haven’t created any events yet.</p>
            @endif
        </div>

        <!-- Events You're Registered For -->
        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Events You’re Registered For</h2>
            @if ($registeredEvents->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($registeredEvents as $event)
                        <x-dashboard-event-card :event="$event" />
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $registeredEvents->links() }}
                </div>
            @else
                <p class="text-gray-500">You’re not registered for any events yet.</p>
            @endif
        </div>

        <!-- All Events -->
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">All Events</h2>
            @if ($allEvents->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($allEvents as $event)
                        <x-dashboard-event-card :event="$event" />
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $allEvents->links() }}
                </div>
            @else
                <p class="text-gray-500">No events available.</p>
            @endif
        </div>
    </div>
@endsection
