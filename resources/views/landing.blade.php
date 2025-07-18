@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 min-h-screen w-full">
        {{-- Hero section --}}
        <section class="relative bg-indigo-900 text-white py-20">
            <div class="absolute inset-0 overflow-hidden">
                <img src="https://plus.unsplash.com/premium_photo-1683121126477-17ef068309bc?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Event background" class="w-full h-full object-cover opacity-20" />
            </div>
            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-3xl mx-auto text-center mb-10">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        Discover & Create Amazing Events
                    </h1>
                    <p class="text-xl opacity-90 mb-8">
                        Find local events that match your interests or create your own and
                        connect with your community.
                    </p>
                </div>
                <div class="max-w-2xl mx-auto">
                    <x-search-filter-bar class="shadow-lg max-w-2xl mx-auto" />
                </div>
            </div>
        </section>

        {{-- Featured Events --}}
        <section class="py-16 container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                    @if (request('query'))
                        Search results for: "{{ request('query') }}"
                    @else
                        Latest Events
                    @endif
                </h2>
                @if (request('query'))
                    <a href="{{ route('events.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                        View all events
                    </a>
                @endif
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($events as $event)
                    <x-event-card :event="$event" />
                @empty
                    <p>No events found.</p>
                @endforelse
            </div>
            {{-- Pagination --}}
            <div class="mt-8 text-white">
                {{ $events->withQueryString()->links() }}
            </div>
        </section>

        {{-- Popular Locations --}}
        {{-- <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">
                    Popular Locations
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($popularLocations as $location)
                        <x-location-card :location="$location" />
                    @endforeach
                </div>
            </div>
        </section> --}}

        {{-- CTA section --}}
        <x-cta-section />
        {{-- footer --}}
        <x-footer />
    </div>
@endsection
