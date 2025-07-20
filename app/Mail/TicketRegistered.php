<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\Writer\PngWriter;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    /**
     * Create a new message instance.
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        if (!$this->ticket->qr_code || !Storage::disk('public')->exists($this->ticket->qr_code)) {
            $qrCode = new QrCode($this->ticket->ticket_code);
            $qrCode->setSize(300);
            $qrCode->setMargin(10);

            $writer = new PngWriter();
            $qrImage = $writer->write($qrCode);

            $fileName = 'qrcodes/' . $this->ticket->ticket_code . '.png';
            Storage::disk('public')->put($fileName, $qrImage->getString());

            $this->ticket->qr_code = $fileName;
            $this->ticket->save();
        }

        $pdf = Pdf::loadView('tickets.pdf', ['ticket' => $this->ticket]);

        return $this->subject('Your Event Ticket')
            ->view('emails.ticket.registered')
            ->with([
                'ticket' => $this->ticket,
                'qrCodeUrl' => asset('storage/' . $this->ticket->qr_code)
            ])
            ->attachData($pdf->output(), "Ticket-{$this->ticket->id}.pdf", [
                'mime' => 'application/pdf',
            ]);;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Registered',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
