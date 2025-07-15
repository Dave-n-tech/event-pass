@props(['location'])

<a href="{{ route('events.index', ['location' => $location->name]) }}"
   class="group relative rounded-lg overflow-hidden h-64 shadow-sm hover:shadow-md transition-shadow">
  <img src="{{ $location->image_url }}" alt="{{ $location->name }}"
    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
  <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex flex-col justify-end p-6">
    <h3 class="text-white text-xl font-semibold">{{ $location->name }}, {{ $location->state }}</h3>
    <p class="text-white/90 text-sm">{{ $location->event_count }} upcoming events</p>
  </div>
</a>
