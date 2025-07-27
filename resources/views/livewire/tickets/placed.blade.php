@php use Illuminate\Support\Facades\Auth; @endphp

<div class="container mx-auto " wire:poll.5s="refreshTicket">
    <div class="flex w-full lg:w-1/2 mx-auto relative">
        @if($this->showBackButton)
            <div class="hidden md:flex">
                <flux:button href="{{route('admin.dashboard')}}"
                             class=" absolute top-0 left-0 -translate-x-3" icon="arrow-left"></flux:button>
            </div>
        @endif
        @if($this->ticket)
            <div class="block w-full">
                <div class="py-6 px-10 bg-zinc-700 rounded w-full">
                    <div class="block mb-6">
                        <flux:heading size="xl">Ticket Details</flux:heading>
                        <flux:text>{{$this->uuid}}</flux:text>
                    </div>

                    <div class=" w-full flex justify-between items-center">
                        <div>
                            <x-detail-item title="{{'Customer'}}" content="{{$this->ticket->name}}"/>
                            <x-detail-item title="{{'Email'}}" content="{{$this->ticket->email}}"/>
                            <x-detail-item title="{{'phone'}}" content="{{$this->ticket->phone}}"/>
                        </div>
                        <div class="hidden gap-2  md:flex">
                            <x-ticket-state-badge state="{{$this->ticket->status}}"/>
                            @if($this->showActionDropdown)
                                <flux:select wire:model="action" size="sm">
                                    <flux:select.option value="">Choose Action</flux:select.option>
                                    <flux:select.option value="start">Start</flux:select.option>
                                    <flux:select.option value="close">Close</flux:select.option>
                                </flux:select>

                            @endif
                        </div>

                    </div>
                    <div class="flex gap-2  md:hidden mt-5">
                        <x-ticket-state-badge state="{{$this->ticket->status}}"/>
                        @if($this->showActionDropdown)
                            <flux:select wire:model="action" size="sm">
                                <flux:select.option value="">Choose Action</flux:select.option>
                                <flux:select.option value="start">Start</flux:select.option>
                                <flux:select.option value="close">Close</flux:select.option>
                            </flux:select>

                        @endif
                    </div>
                    <div class="mt-6">
                        <flex:text class="text-primary text-xs">Problem Statement:</flex:text>
                        <flux:text>{!! nl2br(e($this->ticket->issue)) !!}</flux:text>
                    </div>
                    <div class="mt-6">
                        @if($this->ticketIsActive)
                            <div class=" flex-col bg-zinc-800 border border-gray-600 rounded my-6 py-6 px-3">
                                <livewire:tickets.support.conversation :ticket="$this->ticket"/>
                            </div>
                        @else
                            <x-ticket-created-notice/>
                        @endif
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>
