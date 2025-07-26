@props([
    'title',
    'content'
])
<div class="flex gap-2">
    <flux:heading>
        {{$title}}
    </flux:heading>
    <flux:text>
        {{$content}}
    </flux:text>
</div>
