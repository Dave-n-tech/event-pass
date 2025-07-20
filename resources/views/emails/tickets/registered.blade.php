<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Your Ticket</title>
</head>

<body>
    <h2>Hello, {{ $ticket->user->name }}</h2>

    <p>Thank you for registering for <strong>{{ $ticket->event->title }}</strong>.</p>

    <p>Your ticket code is: <strong>{{ $ticket->ticket_code }}</strong></p>

    <p style="font-weight: 700;">Here’s your ticket QR code:</p>

    <div style="text-align: center; margin: 20px 0;">
        <img src="{{ $qrCodeUrl }}" alt="QR Code" style="width:200px;" />
    </div>

    <p>Show this QR code at the event entrance for verification.</p>

    <p>Event Details:</p>
    <ul>
        <li><strong>Date:</strong> {{ $ticket->event->event_date->format('F j, Y') }}</li>
        <li><strong>Location:</strong> {{ $ticket->event->location }}</li>
    </ul>

    <p>Your ticket is attached as a PDF. See you at the event!</p>

    <p>See you there!</p>

    <p>— EventPass</p>
</body>

</html>
