<?php

namespace App\Livewire\Tickets;

use App\Models\Ticket;
use Livewire\Component;

class Placed extends Component
{
    public string $uuid;

    public Ticket $ticket;

    public function mount(): void
    {
        $uuidParam = request('uuid');
        if (! isset($uuidParam)) {
            $this->redirect(route('ticket.create'));

            return;
        }
        $this->uuid = $uuidParam;
        $this->refreshTicket();
    }

    public function render()
    {
        return view('livewire.tickets.placed')->layout('components.layouts.public');
    }

    public function refreshTicket(): void
    {
        $this->ticket = Ticket::with('messages')->where(['token' => $this->uuid])->sole();
    }
}
