<?php

namespace App\Jobs;

use App\Mail\TicketAcknowledgement;
use App\Models\Ticket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendTicketAcknowledgementJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Ticket $ticket) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->ticket->email)->send(new TicketAcknowledgement($this->ticket));
    }
}
