<div class="container mx-auto">
    <div class="lg:w-1/3 md:w-full mx-auto">
        <form class="dark border-b-gray-400  rounded w-full">
            <div class="py-4">

                <div class="flex w-full flex-col text-center">
                     <span class="flex justify-center h-36">
                            <x-app-logo-icon class="size-9"/>
                    </span>
                    <flux:heading size="xl">{{ $title }}</flux:heading>
                    <flux:subheading>{{ $description }}</flux:subheading>
                </div>

            </div>
            <div class="flex mb-6 w-full">
                <div class="w-full">
                    <flux:field>
                        <flux:label>Name</flux:label>
                        <flux:input wire:model="formData.name" required autofocus placeholder="John Doe"/>
                        <flux:error name="formData.name"/>
                    </flux:field>
                </div>
            </div>
            <div class="block md:flex  gap-2">
                <div class="flex-1/2 mb-6">
                    <flux:field>
                        <flux:label>Email</flux:label>
                        <flux:input wire:model="formData.email" type="email" placeholder="john@example.com" required/>
                        <flux:error name="formData.email"/>
                    </flux:field>
                </div>
                <div class="flex-1/2 mb-6">
                    <flux:field>
                        <flux:label>Phone</flux:label>
                        <flux:input wire:model="formData.phone" placeholder="0xx xxx xxxx"/>
                        <flux:error name="formData.phone"/>
                    </flux:field>
                </div>
            </div>
            <div class="flex mb-10">
                <div class="w-full">
                    <flux:field>
                        <flux:label>Problem Statement</flux:label>
                        <flux:description>Enter your problem statement .</flux:description>
                        <flux:textarea
                            placeholder="I have an issue with..."
                            wire:model="formData.issue"
                        />
                        <flux:error name="formData.issue"/>
                    </flux:field>
                </div>
            </div>
            <div class="flex justify-center">
                <flux:button class="w-full" variant="primary" wire:click="createTicket">Submit</flux:button>
            </div>
        </form>
    </div>
</div>

