@props([
    'state' => 'pending',
])

@php
    $classes = Flux::classes('shrink-0')->add(
        match ($state) {
            'pending' => 'bg-gray-500!',
            'assigned' => 'bg-blue-300!',
            'opened' => 'bg-blue-400!',
            'working' => 'bg-primary!',
            'closed' => 'bg-green!',
        },
    );

 @endphp

<flux:badge variant="pill"   {{ $attributes->class($classes) }} icon="clock">{{$state}}</flux:badge>
