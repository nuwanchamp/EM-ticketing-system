<?php

namespace App\Livewire\Tickets;

use App\Enums\TicketState;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Placed extends Component
{
    public string $uuid;

    public string $action;

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
        if (Auth::check()) {
            if (! Gate::allows('view-ticket', [$this->ticket])) {
                abort(404);
            }
            Ticket::where(['token' => $this->uuid])->update(['status' => TicketState::OPENED]);
        }
    }

    public function updatedAction(): void
    {
        if ($this->action === 'start') {
            Ticket::where(['token' => $this->uuid])->update(['status' => TicketState::WORKING]);
        } else {
            Ticket::where(['token' => $this->uuid])->update(['status' => TicketState::CLOSED]);
        }
    }

    public function render()
    {
        return view('livewire.tickets.placed')->layout('components.layouts.public');
    }

    public function refreshTicket(): void
    {
        $this->ticket = Ticket::with('messages')->where(['token' => $this->uuid])->sole();
    }

    public function getTicketIsActiveProperty(): bool
    {
        return $this->ticket->status === TicketState::WORKING->value;
    }

    public function getShowActionDropdownProperty(): bool
    {
        return Auth::check();
    }
    public function getShowBackButtonProperty(): bool
    {
        return Auth::check();
    }
}
