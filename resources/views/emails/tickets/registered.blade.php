<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Your Ticket</title>
</head>

<body>
    <h2>Hello, {{ $ticket->user->name }}</h2>

    <p>Thank you for registering for <strong>{{ $ticket->event->title }}</strong>.</p>

    <p>Here’s your ticket QR code:</p>

    <div style="text-align: center; margin: 20px 0;">
        <object data="{{ $qrCodeUrl }}" type="image/svg+xml" width="200" height="200">
            Your QR code
        </object>
    </div>

    <p>Show this QR code at the event entrance for verification.</p>

    <p>Event Details:</p>
    <ul>
        <li><strong>Date:</strong> {{ $ticket->event->event_date->format('F j, Y') }}</li>
        <li><strong>Location:</strong> {{ $ticket->event->location }}</li>
    </ul>

    <p>See you there!</p>

    <p>— EventNest</p>
</body>

</html>
