<x-layouts.app.witout-sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.witout-sidebar>
