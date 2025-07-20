@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('dashboard.ticket') }}" class="my-4 text-indigo-600 hover:text-indigo-800 font-medium">
        < back</a>
            <div class="max-w-2xl mx-auto p-6 bg-white shadow rounded-lg mt-6">
                <h2 class="text-2xl font-bold mb-4">Ticket Details</h2>

                <div class="mb-4">
                    <p><span class="font-semibold">Event:</span> {{ $ticket->event->title }}</p>
                    <p><span class="font-semibold">Date:</span>
                        {{ \Carbon\Carbon::parse($ticket->event->date)->format('d M Y') }}
                    </p>
                    <p><span class="font-semibold">Time:</span> {{ $ticket->event->time }}</p>
                </div>

                <div class="mb-4">
                    <p><span class="font-semibold">Name:</span> {{ $ticket->user->name }}</p>
                    <p><span class="font-semibold">Email:</span> {{ $ticket->user->email }}</p>
                    <p><span class="font-semibold">Ticket ID:</span> {{ $ticket->ticket_code ? $ticket->ticket_code : $ticket->id }}</p>
                </div>

                @if ($ticket->qr_code)
                    <img src="{{ asset('storage/'.$ticket->qr_code) }}" alt="QR Code" class="w-48 h-48 mx-auto">
                @endif


                <div class="mt-6 text-center">
                    <a href="{{ route('dashboard.download-ticket', $ticket->id) }}"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        Download Ticket PDF
                    </a>
                </div>
            </div>
        @endsection
