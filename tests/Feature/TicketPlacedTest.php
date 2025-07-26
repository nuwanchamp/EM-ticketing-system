<?php

use App\Livewire\Tickets\Placed;
use App\Models\Ticket;
use Livewire\Livewire;

it('will render the ticket placed page successfully', function () {
    Ticket::factory()->create([
        'token' => 'random-uuid',
    ]);
    $this->get('/ticket/placed?uuid=random-uuid')->assertOk();
});
it('will render 404 if invalid uuid give', function () {
    $this->get('/ticket/placed?uuid=random-uuid')->assertNotFound();
});

it('will redirect if uuid not provided', function () {
    $this->get(route('ticket.placed'))->assertRedirect(route('ticket.create'));
});
it('will display the ticket details page correctly', function () {
    Ticket::factory()->create([
        'token' => '1234',
        'name' => 'Test User',
        'email' => 'john@example.com',
        'phone' => '071340989',
        'issue' => 'Lorem Ipsum issue',
    ]);
    $this->get('/ticket/placed?uuid=1234')
        ->assertSee('Ticket Details')
        ->assertSee('Test User');
});
it('will mount ticket details to component with valid uuid', function () {
    $ticket = Ticket::factory()->create([
        'token' => 'valid-uuid',
        'status' => 'open',
        'name' => 'Test User',
        'issue' => 'Lorem Ipsum issue',
        'email' => 'test@sample.com',
    ]);

    Livewire::withQueryParams(['uuid' => 'valid-uuid'])->test(Placed::class)
        ->assertSet('uuid', $ticket->token)
        ->assertSee('Test User')
        ->assertSee('Lorem Ipsum issue')
        ->assertSee('test@sample.com')
        ->assertSee('open');
});
it('will poll for updates at specified intervals', function () {
    $ticket = Ticket::factory()->create([
        'token' => '1234',
    ]);
    $this->get('ticket/placed?uuid=1234')->assertSee('wire:poll.5s="refreshTicket"', false);

});
