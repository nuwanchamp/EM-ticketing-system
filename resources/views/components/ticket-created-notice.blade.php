<flux:callout icon="ticket" variant="secondary" class="bg-primary-accent" inline>
    <flux:callout.heading>Your ticket is Placed</flux:callout.heading>
    <flux:callout.text>
        Your issue is our first priority. We will get back to you as soon as possible.
        <span class="font-bold block mt-3">
                                        We have sent you an email with the ticket details which you can use it check status later.
                                    </span>
    </flux:callout.text>
    <x-slot name="actions">
        <div class="hidden md:block">
            <flux:button variant="ghost" class="cursor-pointer">Cancel Ticket</flux:button>
        </div>
        <div class="block md:hidden">
            <flux:button variant="primary" class="cursor-pointer">Cancel Ticket</flux:button>
        </div>
    </x-slot>
</flux:callout>
