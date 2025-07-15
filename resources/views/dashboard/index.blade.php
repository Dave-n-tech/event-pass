@extends('layouts.dashboard')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">

            {{-- Stats Section --}}
            <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                {{-- Example widget --}}
                @foreach ($stats as $stat)
                    <div class="bg-white overflow-hidden shadow rounded-lg p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-indigo-100 p-2 rounded-full">
                                {{-- Replace with your icon --}}
                                <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 7V3M16 7V3M4 11h16M10 19h4" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-500">{{ $stat['name'] }}</h3>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stat['value'] }}</p>
                                <p class="text-sm text-green-600 mt-1">▲ {{ $stat['change']['value'] }}% this month</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Upcoming Events Section --}}
            <div class="mt-10">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-lg font-medium text-gray-900">Your Upcoming Events</h2>
                    <a href="{{ route('dashboard.my-events') }}"
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-500 flex items-center">
                        My events
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($upcomingEvents as $event)
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <img class="h-40 w-full object-cover" src={{ $event->image }} alt="Event">
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $event->title }}</h3>
                                <p class="text-[11px] text-gray-500">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y')}}</p>
                                <p class="text-sm text-gray-400 mt-2">{{$event->description}}</p>
                                <p class="text-sm text-gray-900 mt-2">{{ $event->location }}</p>
                                @if ($event->price == 0)
                                    <p class="text-sm text-green-600 font-bold mt-2">Free</p>
                                @else
                                    <p class="text-sm text-gray-900 font-bold mt-2">
                                        ${{ number_format($event->price) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Recent Activity Section --}}
            <div class="mt-10">
                <h2 class="text-lg font-medium text-gray-900 mb-5">Recent Activity</h2>
                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul class="flex flex-col space-y-4 divide-y divide-gray-200">
                        @foreach ($recentActivities as $activity)
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-indigo-600 truncate">{{$activity['event']}}</p>
                                        <p
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{$activity['date']}}</p>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <p class="flex items-center text-sm text-gray-500">{{$activity['details']}}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
