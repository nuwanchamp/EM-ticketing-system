<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use App\Mail\TicketAcknowledgement;
use Illuminate\Support\Facades\Mail;

class SendTicketAcknoledgement
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TicketCreated $event): void
    {
        $ticket = $event->getTicket();
        Mail::to($ticket->email)->send(new TicketAcknowledgement($ticket));
    }
}
