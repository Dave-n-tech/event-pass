<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - EventPass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CSS (adjust as needed) --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    {{-- Alpine.js for toggle --}}
    <script defer src="//unpkg.com/alpinejs"></script>
</head>

<body class="bg-gray-100 h-screen overflow-hidden" x-data="{ open: false }">

    <div class="flex h-full">
        {{-- Sidebar for desktop --}}
        @include('dashboard.partials.dashboard-sidebar')

        {{-- Mobile Sidebar --}}
        @include('dashboard.partials.dashboard-mobile-sidebar')

        {{-- Main Content --}}
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            {{-- Top bar --}}
            <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
                <button type="button" class="md:hidden px-4 border-r border-gray-200 text-gray-500 focus:outline-none"
                    @click="open = true">
                    <x-lucide-menu class="h-6 w-6" />
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex items-center md:hidden">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3M16 7V3M4 11h16M4 19h16M4 15h16M4 11v8a2 2 0 002 2h12a2 2 0 002-2v-8"></path>
                        </svg>
                        <span class="ml-2 text-lg font-medium text-gray-800">EventPass</span>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <button class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none">
                            <x-lucide-bell class="h-6 w-6" />
                        </button>
                    </div>
                </div>
            </div>

            {{-- Dynamic content --}}
            <main class="flex-1 relative overflow-y-auto p-6 focus:outline-none">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
