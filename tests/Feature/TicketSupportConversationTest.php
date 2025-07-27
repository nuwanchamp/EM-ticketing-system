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

it('will set ticket property', function () {
    $ticket = Ticket::factory()->create(['token' => '1235']);
    Livewire::test(Conversation::class, ['ticket' => $ticket])->assertSet('ticket', $ticket);
});

it('will send message on submission', function () {
    $ticket = Ticket::factory()->create(['token' => '1235']);
    Livewire::test(Conversation::class, ['ticket' => $ticket])
        ->set('messageContent', 'Test Message')
        ->call('sendMessage');
    $this->assertDatabaseHas('messages', ['content' => 'Test Message', 'ticket_id' => $ticket->id]);
});
it('will not send message on submission if message is empty', function () {
    $ticket = Ticket::factory()->create(['token' => '1235']);
    $livewire = Livewire::test(Conversation::class, ['ticket' => $ticket])
        ->set('messageContent', '')
        ->call('sendMessage');
    $livewire->assertHasErrors(['messageContent']);
    $this->assertDatabaseMissing('messages', ['content' => '', 'ticket_id' => $ticket->id]);
});
