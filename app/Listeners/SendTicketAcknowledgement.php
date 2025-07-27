<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use App\Jobs\SendTicketAcknowledgementJob;

class SendTicketAcknowledgement
{
    /**
     * Handle the event.
     */
    public function handle(TicketCreated $event): void
    {
        $ticket = $event->getTicket();
        SendTicketAcknowledgementJob::dispatch($ticket);
    }
}
