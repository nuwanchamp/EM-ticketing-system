<main>
    <flux:field class="mb-6">
        <flux:input wire:model.debounce.100ms="search" wire:keyup="updateSearch" type="text" class="w-full"
                    placeholder="Search by Customer"></flux:input>
    </flux:field>
    <div>
            <x-table>
            <x-table.columns>
                <x-table.column>Ticket</x-table.column>
                <x-table.column>Name</x-table.column>
                <x-table.column>Email</x-table.column>
                <x-table.column>Phone</x-table.column>
                <x-table.column>Problem</x-table.column>
                <x-table.column>Status</x-table.column>
            </x-table.columns>
            <x-table.rows>

                @foreach($this->assignedTickets as $ticket)
                    <x-table.row :key="$ticket->id" wire:click.stop="navigateToTicket('{{$ticket->token}}')"
                                 isNew="{{$ticket->status === 'pending' ? 1 : 0}}">
                        <x-table.cell class="flex items-center gap-3">
                            {{ $ticket->id }}
                        </x-table.cell>
                        <x-table.cell class="whitespace-nowrap">
                            {{ $ticket->name }}
                        </x-table.cell>
                        <x-table.cell variant="strong">
                            {{ $ticket->email }}
                        </x-table.cell>
                        <x-table.cell>
                            {{$ticket->phone ?? 'N/A'}}
                        </x-table.cell>
                        <x-table.cell class="whitespace-nowrap text-overflow-ellipsis">
                            {{$ticket->issue}}
                        </x-table.cell>
                        <x-table.cell>
                            <x-ticket-state-badge state="{{$ticket->status}}"/>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-table.rows>
        </x-table>
        <div class="mt-4">
            {{ $this->assignedTickets->links() }}
        </div>
    </div>
</main>
