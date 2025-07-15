<div class="md:hidden fixed inset-0 z-40 flex" x-show="open">
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="open = false"></div>
    <div class="relative flex flex-col w-full max-w-xs bg-white">
        <div class="absolute top-0 right-0 -mr-12 pt-2">
            <button class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none"
                @click="open = false">
                <x-lucide-x class="h-6 w-6 text-white" />
            </button>
        </div>

        @php
            $navigation = [
                ['name' => 'Dashboard', 'href' => route('dashboard'), 'icon' => 'home'],
                ['name' => 'My Events', 'href' => route('dashboard.my-events'), 'icon' => 'calendar-days'],
                ['name' => 'Create Event', 'href' => route('dashboard.create-event'), 'icon' => 'plus'],
                ['name' => 'My Wallet', 'href' => route('dashboard.wallet'), 'icon' => 'wallet'],
                ['name' => 'Profile Settings', 'href' => route('dashboard.profile-settings'), 'icon' => 'user'],
            ];
        @endphp

        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
            <a href="{{ url('/') }}" class="flex items-center px-4">
                <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3M16 7V3M4 11h16M4 19h16M4 15h16M4 11v8a2 2 0 002 2h12a2 2 0 002-2v-8"></path>
                </svg>
                <span class="ml-2 text-xl font-bold text-gray-800">EventPass</span>
            </a>
            <nav class="mt-5 px-2 space-y-1">
                @foreach ($navigation as $item)
                    <a href="{{ $item['href'] }}"
                        class="group flex items-center px-2 py-2 text-base font-medium rounded-md
                                    {{ request()->url() === $item['href'] ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
                        @click="open = false">
                        <x-dynamic-component :component="'lucide-' . $item['icon']"
                            class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->url() === $item['href'] ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" />
                        {{ $item['name'] }}
                    </a>
                @endforeach
            </nav>
        </div>
    </div>
    <div class="flex-shrink-0 w-14"></div>
</div>
