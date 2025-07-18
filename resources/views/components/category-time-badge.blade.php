@props(['event'])

@php
    use Illuminate\Support\Carbon;

    try {
        $formattedTime = $event->time ? Carbon::parse($event->time)->format('g:i A') : 'Time not specified';
    } catch (\Exception $e) {
        $formattedTime = 'Invalid time';
    }

    $category = $event->category ?? 'Uncategorized';
@endphp

<div class="flex gap-2 mt-2">
    {{-- Category Badge --}}
    <span
        class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 7h.01M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
        </svg>
        {{ $category }}
    </span>

    {{-- Time Badge --}}
    <span
        class="inline-flex items-center gap-1 bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6v6l4 2m-4-10a9 9 0 100 18 9 9 0 000-18z" />
        </svg>
        {{ $formattedTime }}
    </span>
</div>
