<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64">
        <div class="flex flex-col flex-1 border-r border-gray-200 bg-white">
            {{-- Logo --}}
            <div class="flex items-center h-16 flex-shrink-0 px-4 border-b border-gray-200">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3M16 7V3M4 11h16M4 19h16M4 15h16M4 11v8a2 2 0 002 2h12a2 2 0 002-2v-8"></path>
                    </svg>
                    <span class="text-xl font-bold text-gray-800">EventPass</span>
                </a>
            </div>

            {{-- Navigation --}}
            @php
                $navigation = [
                    ['name' => 'Dashboard', 'href' => route('dashboard'), 'icon' => 'home'],
                    ['name' => 'My Events', 'href' => route('dashboard.my-events'), 'icon' => 'calendar-days'],
                    ['name' => 'Create Event', 'href' => route('dashboard.create-event'), 'icon' => 'plus'],
                    ['name' => 'My Wallet', 'href' => route('dashboard.wallet'), 'icon' => 'wallet'],
                    ['name' => 'Profile Settings', 'href' => route('dashboard.profile-settings'), 'icon' => 'user'],
                ];
            @endphp

            <div class="flex-1 flex flex-col overflow-y-auto pt-5 pb-4">
                <nav class="mt-5 flex-1 px-2 space-y-1">
                    @foreach ($navigation as $item)
                        <a href="{{ $item['href'] }}"
                            class="group flex items-center px-2 py-2 text-sm font-medium rounded-md
                                        {{ request()->url() === $item['href'] ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <x-dynamic-component :component="'lucide-' . $item['icon']"
                                class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->url() === $item['href'] ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" />
                            {{ $item['name'] }}
                        </a>
                    @endforeach
                </nav>
            </div>

            {{-- User Profile --}}
            <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                <div class="flex-shrink-0 w-full group block">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                            <x-lucide-user class="h-6 w-6 text-gray-500" />
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'Guest' }}</p>
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="text-xs font-medium text-gray-500 group-hover:text-gray-700 flex items-center space-x-1">
                                        <x-lucide-log-out class="h-3 w-3" />
                                        <span>Logout</span>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-xs font-medium text-indigo-600 hover:underline">Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
