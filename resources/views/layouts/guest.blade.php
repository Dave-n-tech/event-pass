<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EventPass') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    @include('layouts.navigation')
    <div class="min-h-screen flex flex-col sm:justify-start items-center pt-6 sm:pt-0 bg-gray-200">
        <div class="mt-8">
            <svg class="mx-auto h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3M16 7V3M4 11h16M4 19h16M4 15h16M4 11v8a2 2 0 002 2h12a2 2 0 002-2v-8"></path>
            </svg>
            @if (request()->routeIs('login'))
                <h1 class="font-extrabold text-3xl text-gray-800">
                    Sign in to your account
                </h1>
                <p class="mt-2 text-center text-[14px]">Don't have an account? <a href="/register"
                        class="text-indigo-700 hover:text-indigo-500 font-semibold">Sign up</a></p>
            @else
                <h1 class="font-extrabold text-3xl text-gray-800">
                    Create your account
                </h1>
                <p class="mt-2 text-center text-[14px]">Already have an account? <a href="/login"
                        class="text-indigo-700 hover:text-indigo-500 font-semibold">Log in</a></p>
            @endif
        </div>

        <div class="w-full sm:max-w-md mt-4 mx-2 px-6 py-8 bg-gray-100 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
