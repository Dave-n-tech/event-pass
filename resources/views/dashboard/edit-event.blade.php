@extends('layouts.dashboard')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <a href="{{ route('dashboard.my-events') }}" class="text-indigo-600 hover:underline mb-4 inline-block">
            ← Back to My Events
        </a>

        <h1 class="text-2xl font-bold mb-6">Edit Event</h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $event->title) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" required>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" required>{{ old('description', $event->description) }}</textarea>
            </div>

            {{-- Date --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Event Date</label>
                <input type="date" name="event_date"
                    value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('Y-m-d')) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" required>
            </div>

            {{-- Location --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location', $event->location) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" required>
            </div>

            {{-- Capacity --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Capacity</label>
                <input type="number" name="capacity" value="{{ old('capacity', $event->capacity) }}" min="1"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
            </div>

            {{-- price --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Price</label>
                <input type="number" name="price" value="{{ old('price', $event->price) }}"
                    min="0" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
            </div>

            {{-- Image Upload with Preview --}}
            <div class="mb-6">
                <div>
                    <label class="block font-medium">Upload Image</label>
                    <input type="file" name="image_file" id="image_file" class="form-input mt-1">
                </div>

                <div>
                    <label class="block font-medium">Or Provide Image URL</label>
                    <input type="url" name="image_url" id="image_url" class="form-input w-full"
                        value="{{ old('image_url') }}">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Image Preview</label>
                    <img id="image_preview"
                        src="{{ $event->image_url ? $event->image_url : ($event->image_file ? asset('storage/' . $event->image_file) : '') }}"
                        alt="Image Preview" class="w-64 h-40 object-cover border border-gray-300 rounded">
                </div>
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                    Update Event
                </button>
            </div>
        </form>
    </div>

    {{-- Image Preview Script --}}
    <script>
        const fileInput = document.getElementById('image_file');
        const urlInput = document.getElementById('image_url');
        const preview = document.getElementById('image_preview');

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    preview.src = event.target.result;
                };

                reader.readAsDataURL(file);
            }
        });

        urlInput.addEventListener('input', function() {
            preview.src = this.value;
        });
    </script>
@endsection
