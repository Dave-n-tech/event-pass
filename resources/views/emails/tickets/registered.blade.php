@component('mail::message')
# Hello {{ $ticket->user->name }},

You have successfully registered for **{{ $event->title }}**!

**Event Details:**
- Date: {{ $event->event_date }}
- Location: {{ $event->location ?? 'To be announced' }}

Please find your ticket QR code attached to this email.  
Present it at the event entrance for verification.

Thanks for using Event Pass!

Regards,<br>
{{ config('app.name') }}
@endcomponent
