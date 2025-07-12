@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <h1>Create Event</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <label>Title:</label>
        <input type="text" name="title" class="border p-2 w-full" value="{{ old('title') }}">

        <label>Description:</label>
        <textarea name="description" class="border p-2 w-full">{{ old('description') }}</textarea>

        <label>Location:</label>
        <input type="text" name="location" class="border p-2 w-full" value="{{ old('location') }}">

        <label>Date:</label>
        <input type="datetime-local" name="event_date" class="border p-2 w-full" value="{{ old('event_date') }}">

        <label>Price (₦):</label>
        <input type="number" name="price" step="0.01" class="border p-2 w-full" value="{{ old('price', 0) }}">

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white">Create Event</button>
    </form>
</div>
@endsection
