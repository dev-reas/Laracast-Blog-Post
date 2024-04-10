@props(['trigger'])
<div x-data="{ open: false }" @click.away="open = false" class="relative">
    {{-- Trigger --}}
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    {{-- Links --}}
    <div x-show="open" class="py-2 absolute bg-gray-100 w-full mt-2 rounded-xl z-50 overflow-auto max-h-52"
        style="display:none">
        {{ $slot }}
    </div>
</div>
