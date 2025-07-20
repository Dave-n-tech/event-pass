<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Ticket PDF</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .container {
            padding: 20px;
            border: 2px dashed #333;
            width: 100%;
            max-width: 600px;
            margin: auto;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .section {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">Event Ticket</div>

        <div class="section">
            <strong>Event:</strong> {{ $ticket->event->title }} <br>
            <strong>Date:</strong> {{ \Carbon\Carbon::parse($ticket->event->date)->format('d M Y') }} <br>
            <strong>Time:</strong> {{ $ticket->event->time }}
        </div>

        <div class="section">
            <strong>Name:</strong> {{ $ticket->user->name }} <br>
            <strong>Email:</strong> {{ $ticket->user->email }} <br>
            <strong>Ticket ID:</strong> {{ $ticket->id }}
        </div>

        <div class="section">
            @if ($ticket->qr_code)
                <img src="{{ asset('storage/' . $ticket->qr_code) }}" alt="QR Code" class="w-48 h-48">
            @endif
        </div>
    </div>
</body>

</html>
