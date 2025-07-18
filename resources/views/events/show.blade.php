@extends("layouts.$layout")

@section('content')
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        @if ($layout === 'app')
            <a href="{{ route('events.index') }}" class="my-4 text-indigo-600 hover:text-indigo-800 font-medium">
                < back</a>
        @endif
        @if ($layout === 'dashboard')
            <a href="{{ route('dashboard.my-events') }}" class="my-4 text-indigo-600 hover:text-indigo-800 font-medium">
                < back</a>
        @endif
        <div class="bg-white shadow overflow-hidden rounded-lg">
            <img src="{{ $event->display_image ?? 'https://via.placeholder.com/1200x400' }}" alt="{{ $event->title }}"
                class="w-full h-72 object-cover rounded-t-lg">

            <div class="px-6 py-8">
                <x-category-time-badge :event="$event" />
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $event->title }}</h1>

                <p class="text-gray-600 mb-4">{{ $event->description }}</p>

                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V7H3v10a2 2 0 002 2z" />
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</span>
                </div>

                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 12.414a4 4 0 10-1.414 1.414l4.243 4.243a1 1 0 001.414-1.414z" />
                    </svg>
                    <span>{{ $event->location ?? 'Location TBD' }}</span>
                </div>

                <div class="flex items-center text-sm text-gray-500 mb-6">
                    <span class="font-semibold text-gray-700">Price:</span>
                    <span class="ml-2">{{ $event->price ? '$' . number_format($event->price, 2) : 'Free' }}</span>
                </div>

                @if (Auth::check())
                    @if ($hasRegistered)
                        <p class="text-green-600">You’ve already registered for this event.</p>
                    @else
                        <form action="{{ route('tickets.store', $event) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                                Register for this Event
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                        Login to Register
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
