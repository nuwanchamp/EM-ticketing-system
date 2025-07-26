<?php

namespace App\Livewire\Tickets;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Livewire\Component;
use phpDocumentor\Reflection\Types\ArrayKey;

class Create extends Component
{
    public string $title = 'Open a New Support Ticket';

    public string $description = 'Please fill out the form below and we will get back to you as soon as possible.';

    /**
     * @var ArrayKey token
     * @var ArrayKey name
     * @var ArrayKey email
     * @var ArrayKey phone
     * @var ArrayKey issue
     */
    public array $formData = [];

    protected function messages(): array
    {
        return [
          'formData.issue.required' => 'Problem Statement is required',
          'formData.name.required' => 'Customer name is required',
          'formData.email.required' => 'Customer email is required',
          'formData.email.email' => 'Customer email is invalid',
        ];
    }

    protected function rules(): array
    {
        return [
            'formData.name' => 'required|string',
            'formData.email' => 'required|email',
            'formData.issue' => 'required|string',
            'formData.phone' => 'nullable|string',
        ];
    }

    public function createTicket(): void
    {

        $this->validate();
        data_set($this->formData, 'token', Str::uuid()->toString());
        Ticket::factory()->create([...$this->formData]);

        $this->redirect(route('ticket.placed', ['uuid' => data_get($this->formData, 'token')]), true);
    }

    public function render()
    {
        return view('livewire.tickets.create')->layout('components.layouts.public');
    }
}
