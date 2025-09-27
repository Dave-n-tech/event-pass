@props(['event', 'hasRegistered' => false])

<div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
    <img src="{{ $event->display_image }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
    <div class="p-4">
        <x-category-time-badge :event="$event" />
        <a href="{{ route('dashboard.event-details', $event->id) }}">
            <h3 class="text-lg font-semibold mb-2 text-gray-900 hover:text-indigo-600 truncate">{{ $event->title }}</h3>
        </a>

        @if (Auth::check())
            @if ($hasRegistered)
                <p class="text-green-600 text-[12px] mb-2">Already registered</p>
            @else
                @if ($event->user_id === Auth::id())
                    <p class="text-purple-600 text-[12px] mb-2">Your event</p>
                @endif
            @endif
        @endif

        <p class="text-sm text-gray-500 mb-1">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</p>
        <p class="text-sm text-gray-500">{{ $event->location }}</p>
        <p class="mt-2 font-medium">{{ $event->price > 0 ? '₦' . $event->price : 'Free' }}</p>
        <a href="{{ route('dashboard.event-details', $event->id) }}"
            class="inline-block mt-4 text-indigo-600 hover:text-indigo-800">
            View Details
        </a>
    </div>
</div>
