<?php

namespace App\Livewire\Tickets\Support;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Conversation extends Component
{
    public Ticket $ticket;

    public string $messageContent = '';

    public string $senderType = 'agent';

    public function mount(Ticket $ticket): void
    {
        $this->ticket = $ticket;
        if (Auth::check()) {
            $this->senderType = 'agent';
        } else {
            $this->senderType = 'customer';
        }
    }

    public function render(): View
    {
        return view('livewire.tickets.support.conversation', [
            'messages' => $this->ticket->messages()
                ->orderBy('created_at', 'asc')
                ->get(),
        ]);
    }

    public function sendMessage(): void
    {
        $this->validate([
            'messageContent' => 'required|string',
        ]);

        $this->ticket->messages()->create([
            'sender_type' => $this->senderType,
            'content' => $this->messageContent,
        ]);
        $this->messageContent = '';
        $this->ticket->refresh();
        $this->dispatch('message-sent');
    }
}
