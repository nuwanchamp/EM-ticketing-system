<div class="container mx-auto" wire:poll.5s="refreshTicket">
    <div class="flex w-full lg:w-1/2 mx-auto" >
        @if($this->ticket)
            <div class="block w-full">
                <div class="py-6 px-10 bg-zinc-700 rounded w-full">
                    <div class="block mb-6">
                        <flux:heading size="xl">Ticket Details</flux:heading>
                        <flux:text >{{$this->uuid}}</flux:text>
                    </div>

                    <div class=" w-full flex justify-between items-center">
                        <div>
                            <x-detail-item title="{{'Customer'}}" content="{{$this->ticket->name}}"/>
                            <x-detail-item title="{{'Email'}}" content="{{$this->ticket->email}}"/>
                            <x-detail-item title="{{'phone'}}" content="{{$this->ticket->phone}}"/>
                        </div>
                        <div class="block">
                            <flux:badge variant="pill" icon="clock">{{$this->ticket->status}}</flux:badge>
                        </div>

                    </div>
                    <div class="mt-6">
                        <flex:text  class="text-primary text-xs">Problem Statement:</flex:text>
                        <flux:text>{!! nl2br(e($this->ticket->issue)) !!}</flux:text>
                    </div>
                    <div class=" flex-col bg-zinc-800 border border-gray-600 rounded my-6 py-6 px-3">
                        <livewire:tickets.support.conversation :ticket="$this->ticket"/>
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>
