@props(['action' => route('events.index')])

<div {{ $attributes->merge(['class' => 'w-full']) }} x-data="{ showFilters: false }">
    <form action="{{ $action }}" method="GET" class="relative text-black">
        <input
            type="text"
            name="query"
            placeholder="Search events by name, location, or keyword..."
            class="w-full pl-10 pr-16 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            value="{{ request('query') }}"
        />
        {{-- search button --}}
        <button type="submit">
            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 21l-4.35-4.35m1.65-5.65A7 7 0 1 1 5 5a7 7 0 0 1 13.3 5.65z"></path>
            </svg>
        </button>

        <button type="button"
            @click="showFilters = !showFilters"
            class="absolute right-3 top-2.5 p-1 rounded-md hover:bg-gray-100"
        >
            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </form>

    <div x-show="showFilters" class="mt-3 p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                <input
                    type="date"
                    name="date"
                    class="w-full pl-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500"
                    value="{{ request('date') }}"
                />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input
                    type="text"
                    name="location"
                    placeholder="City or state"
                    class="w-full pl-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500"
                    value="{{ request('location') }}"
                />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select
                    name="category"
                    class="w-full py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500"
                >
                    <option value="">All Categories</option>
                    <option value="music">Music</option>
                    <option value="sports">Sports</option>
                    <option value="arts">Arts & Theater</option>
                    <option value="food">Food & Drink</option>
                    <option value="business">Business & Professional</option>
                    <option value="community">Community & Culture</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                <select
                    name="price"
                    class="w-full py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500"
                >
                    <option value="">Any Price</option>
                    <option value="free">Free</option>
                    <option value="paid">Paid</option>
                    <option value="0-25">$0 - $25</option>
                    <option value="25-50">$25 - $50</option>
                    <option value="50-100">$50 - $100</option>
                    <option value="100+">$100+</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button type="reset"
                @click="showFilters = false"
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 mr-2"
            >
                Close
            </button>
            <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
            >
                Apply Filters
            </button>
        </div>
    </div>
</div>
