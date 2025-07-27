<?php

namespace App\Livewire\Tickets;

use App\Contracts\TicketAssignerInterface;
use App\Enums\TicketState;
use App\Events\TicketCreated;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public string $title = 'Open a New Support Ticket';

    public string $description = 'Please fill out the form below and we will get back to you as soon as possible.';

    /**
     * Form data for ticket creation
     *
     * @var array{
     *     token?: string,
     *     name: string,
     *     email: string,
     *     phone?: string|null,
     *     issue: string,
     *     status?: string,
     *     user_id?: int|null
     * } $formData
     */
    public array $formData = [
        'name' => '',
        'email' => '',
        'issue' => '',
    ];

    public function ticketAssigner(): TicketAssignerInterface
    {
        return app(TicketAssignerInterface::class);

    }

    protected function messages(): array
    {
        return [
          'formData.issue.required' => 'Problem Statement is required',
          'formData.name.required' => 'Customer name is required',
          'formData.email.required' => 'Customer email is required',
          'formData.email.email' => 'Customer email is invalid',
          'formData.phone.max' => 'Invalid Phone Number',
        ];
    }

    protected function rules(): array
    {
        return [
            'formData.name' => 'required|string',
            'formData.email' => 'required|email',
            'formData.issue' => 'required|string',
            'formData.phone' => 'nullable|string|max:10',
        ];
    }

    public function createTicket(): void
    {
        $this->validate();
        $this->setTicketData('token', Str::uuid()->toString());
        $this->setTicketData('status', TicketState::PENDING);
        $nextAgent = $this->ticketAssigner()->getNextAgent();

        $ticket = new Ticket();
        $ticket->fill($this->formData);
        $ticket->agent()->associate($nextAgent);
        $ticket->save();

        $ticket->refresh();

        TicketCreated::dispatch($ticket);

        $this->redirect(route('ticket.placed', ['uuid' => data_get($this->formData, 'token')]), true);
    }

    public function render()
    {
        return view('livewire.tickets.create')->layout('components.layouts.public');
    }

    private function setTicketData(string $key, mixed $value): void
    {
        data_set($this->formData, $key, $value);
    }
}
