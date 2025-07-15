<div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="relative h-48">
        <img src="{{ $event->image ?? 'https://via.placeholder.com/400x300' }}" alt="{{ $event->title }}"
            class="w-full h-full object-cover">
        @if ($event->status === 'draft')
            <span
                class="absolute top-2 right-2 bg-yellow-100 text-yellow-800 px-2 py-1 rounded-md text-xs font-medium">Draft</span>
        @elseif($event->event_date < now())
            <span
                class="absolute top-2 right-2 bg-gray-100 text-gray-800 px-2 py-1 rounded-md text-xs font-medium">Past</span>
        @endif
    </div>
    <div class="p-4">
        <a href="{{ route('dashboard.event-details', $event->id) }}">
            <h3 class="text-lg font-semibold text-gray-900 hover:text-indigo-600 truncate">{{ $event->title }}</h3>
        </a>
        <div class="mt-2 text-sm text-gray-500">
            <div class="flex items-center">
                <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V7H3v10a2 2 0 002 2z" />
                </svg>
                <span>{{ \Carbon\Carbon::parse($event->event_date)->format('M j, Y') }}</span>
            </div>
            <div class="flex items-center">
                <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 12.414a4 4 0 10-1.414 1.414l4.243 4.243a1 1 0 001.414-1.414z" />
                </svg>
                <span>{{ $event->location ?? 'Online' }}</span>
            </div>
        </div>
        <div class="mt-4 flex justify-between">
            <a href="{{ route('dashboard.edit-event', $event->id) }}"
                class="text-sm text-indigo-600 hover:text-indigo-900">Edit</a>
            <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-red-600 hover:text-red-900">Delete</button>
            </form>
        </div>
    </div>
</div>
