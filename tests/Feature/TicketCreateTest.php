<?php

use App\Contracts\TicketAssignerInterface;
use App\Events\TicketCreated;
use App\Livewire\Tickets\Create;
use App\Models\Ticket;
use App\Models\User;
use App\Services\SimpleTicketAssigner;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertCount;

it('Has route for ticket creating ticket', function () {
    $this->get(route('ticket.create'))->assertOk();
});
it('will allow users without login to create ticket', function () {
    $this->get(route('ticket.create'))->assertStatus(200);
});
it('will render ticket create page', function () {
    $this->get(route('ticket.create'))->assertSee('Open a New Support Ticket');
});
it('will create a ticket after submitting the ticket form', function () {
    $mockInterface = \Mockery::mock(TicketAssignerInterface::class);
    $mockInterface->shouldReceive('getNextAgent')->andReturn(
        User::factory()->create(['name' => 'MockUser'])
    );
    app()->instance(TicketAssignerInterface::class, $mockInterface);
    $manageTicketComponent = Livewire::Test(Create::class);
    $manageTicketComponent->set('formData.name', 'John Doe');
    $manageTicketComponent->set('formData.email', 'john@example.com');
    $manageTicketComponent->set('formData.issue', 'Sample Issue');
    $manageTicketComponent->call('createTicket');
    $tickets = Ticket::all();
    assertCount(1, $tickets);
    assertDatabaseHas('tickets', ['name' => 'John Doe', 'issue' => 'Sample Issue', 'email' => 'john@example.com']);
});
it('will validate user data upon submitting ticket form', function () {
    $manageTicketComponent = Livewire::Test(Create::class);
    $manageTicketComponent->set('formData.name', 'John Doe');
    $manageTicketComponent->set('formData.email', 'invalid email');
    $manageTicketComponent->set('formData.issue', 'Sample Issue');
    $manageTicketComponent->assertHasNoErrors(['formData.email']);
    $manageTicketComponent->call('createTicket');
    $manageTicketComponent->assertHasErrors(['formData.email']);
});

it('will validate required fields for Ticket on submission', function () {
    $manageTicketComponent = Livewire::Test(Create::class);
    $manageTicketComponent->call('createTicket');
    $manageTicketComponent->assertHasErrors(['formData.email', 'formData.issue', 'formData.name']);
    $manageTicketComponent->assertHasNoErrors(['formData.phone']);
});

it('will redirect user after creating  a ticket', function () {
    $mockInterface = \Mockery::mock(TicketAssignerInterface::class);
    $mockInterface->shouldReceive('getNextAgent')->andReturn(
        User::factory()->create(['name' => 'MockUser'])
    );
    app()->instance(TicketAssignerInterface::class, $mockInterface);

    $manageTicketComponent = Livewire::Test(Create::class);
    $manageTicketComponent->set('formData.name', 'John Doe');
    $manageTicketComponent->set('formData.email', 'valid@email.com');
    $manageTicketComponent->set('formData.issue', 'Sample Issue');
    $manageTicketComponent->call('createTicket');

    $token = data_get($manageTicketComponent->formData, 'token');

    $manageTicketComponent->assertRedirect(route('ticket.placed', ['uuid' => $token]));
});
it('will use Round Robin ticket assigner', function () {
    config()->set('app.ticketing.ticket_assigner', SimpleTicketAssigner::class);
    $returnValue = app(Create::class)->ticketAssigner();
    expect($returnValue)->toBeInstanceOf(SimpleTicketAssigner::class);
});
it('will notify customer when ticket is created', function () {
    User::factory()->create();
    Event::fake();
    $livewire = Livewire::test(Create::class);
    $livewire->set('formData.name', 'event user')
        ->set('formData.email', 'valid@email.com')
        ->set('formData.issue', 'Sample Issue');

    $livewire->call('createTicket');

    Event::assertDispatched(TicketCreated::class);

});
