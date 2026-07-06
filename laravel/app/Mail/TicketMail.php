<?php

namespace App\Mail;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        $pdf = Pdf::loadView('ticket', [
            'booking' => $this->booking
        ]);

        return $this
            ->subject('E-Ticket Desa Wisata Rowoboni')
            ->view('emails.ticket')
            ->attachData(
                $pdf->output(),
                'E-Ticket-'.$this->booking->ticket_code.'.pdf'
            );
    }
}