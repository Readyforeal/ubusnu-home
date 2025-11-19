<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main class="h-screen">
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
