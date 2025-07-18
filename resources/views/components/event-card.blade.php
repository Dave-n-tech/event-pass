@props(['event'])

<div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
    <img src="{{ $event->display_image }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
    <div class="p-4">
        <x-category-time-badge :event="$event" />
        <h3 class="text-lg font-semibold mb-2">{{ $event->title }}</h3>
        <p class="text-sm text-gray-500 mb-1">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</p>
        <p class="text-sm text-gray-500">{{ $event->location }}</p>
        <p class="mt-2 font-medium">{{ $event->price > 0 ? '$' . $event->price : 'Free' }}</p>
        <a href="{{ route('events.show', $event->id) }}"
            class="inline-block mt-4 text-indigo-600 hover:text-indigo-800">
            View Details
        </a>
    </div>
</div>
