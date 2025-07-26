<?php

use App\Livewire\Tickets\Support\Conversation;
use App\Models\Ticket;
use Livewire\Livewire;

beforeEach(function () {
    Ticket::factory()->create(['token' => '12345']);
});

it('will render inside the placed component', function () {
    $this->get(route('ticket.placed', ['uuid' => '12345']))
        ->assertSee('data-test-id="conversation-box"', false);
});

it('will send messages when send button clicked', function () {
    $ticket = Ticket::factory()->create(['token' => '1235']);
    Livewire::withQueryParams($ticket->toArray())->test(Conversation::class)->assertSet('ticket', $ticket);
});
