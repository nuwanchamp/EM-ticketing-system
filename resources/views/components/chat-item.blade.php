@props([
    'context',
    'type' => 'customer'
])
<div class="flex gap-2 my-4 w-full items-start">
    @if($type == 'customer')
        <flux:callout icon="clock" variant="secondary" class="w-full border border-primary bg-secondary">
            <flux:callout.text>
                {!! nl2br(e($context)) !!}
            </flux:callout.text>
        </flux:callout>
        <flux:profile :chevron="false" avatar="https://unavatar.io/x/calebporzio"/>
    @else
        <flux:profile :chevron="false" avatar="https://unavatar.io/x/calebporzio"/>
        <flux:callout icon="clock" class="w-full">
            <flux:callout.text>
                {!! nl2br(e($context)) !!}
            </flux:callout.text>
        </flux:callout>

    @endif
</div>

