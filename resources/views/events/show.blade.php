@if (auth()->check())
    <form action="{{ route('tickets.store', $event) }}" method="POST">
        @csrf
        <button type="submit" class="px-4 py-2 bg-green-600 text-white">
            Register for this Event
        </button>
    </form>
@else
    <p>Please <a href="{{ route('login') }}" class="underline text-blue-600">log in</a> to register.</p>
@endif
