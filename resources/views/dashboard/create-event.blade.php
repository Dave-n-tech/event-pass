@extends('layouts.dashboard')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Create Event</h1>

            <form action="{{ route('events.store', $event) }}" method="POST" enctype="multipart/form-data" class="mt-6">
                @csrf

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    {{-- Basic Information --}}
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Basic Information</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Provide the basic details about your event.</p>
                    </div>

                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                            <div class="sm:col-span-6">
                                <label for="title" class="block text-sm font-medium text-gray-700">Event Title *</label>
                                <input type="text" name="title" id="title" required
                                    class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description
                                    *</label>
                                <textarea id="description" name="description" rows="4" required
                                    class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">Describe your event and why people should attend.</p>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="category" class="block text-sm font-medium text-gray-700">Category *</label>
                                <select id="category" name="category" required
                                    class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Select a category</option>
                                    <option value="music">Music</option>
                                    <option value="food & drink">Food & Drink</option>
                                    <option value="business">Business & Professional</option>
                                    <option value="arts">Arts & Culture</option>
                                    <option value="sports & fitness">Sports & Fitness</option>
                                    <option value="health & wellness">Health & Wellness</option>
                                    <option value="science and technology">Science & Technology</option>
                                    <option value="community & culture">Community & Culture</option>
                                    <option value="charity">Charity & Causes</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('category')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <div>
                                    <label class="block font-medium">Upload Image</label>
                                    <input type="file" name="image_file" id="image_file" class="form-input mt-1">
                                </div>

                                <div class="mt-1">
                                    <label class="block font-medium">Or Provide Image URL</label>
                                    <input type="url" name="image_url" id="image_url" class="form-input mt-1 w-full"
                                        value="{{ old('image_url') }}">
                                </div>

                                @error('image_file')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror

                                @error('image_url')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror

                                <div class="mb-4 mt-2">
                                    <label class="block font-semibold mb-1">Image Preview</label>
                                    <img id="image_preview"
                                        src="{{ $event->image_url ? $event->image_url : ($event->image_file ? asset('storage/' . $event->image_file) : '') }}"
                                        alt="Image Preview" class="w-64 h-40 object-cover border border-gray-300 rounded">
                                </div>
                            </div>


                        </div>
                    </div>

                    {{-- Date and Time --}}
                    <div class="px-4 py-5 sm:px-6 bg-gray-50">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Date and Time</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">When will your event take place?</p>
                    </div>

                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                            <div class="sm:col-span-3">
                                <label for="event_date" class="block text-sm font-medium text-gray-700">Date *</label>
                                <input type="date" name="event_date" id="event_date" required
                                    class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    value="{{ old('event_date') }}">
                                @error('event_date')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-3">
                                <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                                <input type="time" name="time" id="time"
                                    class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    value="{{ old('time') }}">
                                @error('time')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="px-4 py-5 sm:px-6 bg-gray-50">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Location</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Where will your event take place?</p>
                    </div>

                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                            <div class="sm:col-span-6">
                                <label for="location" class="block text-sm font-medium text-gray-700">Venue Name *</label>
                                <input type="text" name="location" id="location" required
                                    class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    value="{{ old('location') }}">
                                @error('location')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Tickets --}}
                    <div class="px-4 py-5 sm:px-6 bg-gray-50">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Tickets</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Set up your event capacity and pricing.</p>
                    </div>

                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                            <div class="sm:col-span-3">
                                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity *</label>
                                <input type="number" name="capacity" id="capacity" min="1" required
                                    class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    value="{{ old('capacity') }}">
                                @error('capacity')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-3">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                                <input type="number" name="price" id="price" min="0"
                                    class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    value="{{ old('price') }}">
                                @error('price')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">Leave 0 for free events.</p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Publish Event
                    </button>
                </div>

            </form>
        </div>
    </div>

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
