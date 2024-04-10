@props(['heading', 'links'])

<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{ $heading }}
    </h1>

    <div class="flex">
        <aside class="w-48">
            <ul>
                @forelse($links ?? [] as $link)
                    <li>
                        <a href="{{ $link['href'] }}"
                            class="{{ request()->is($link['class']) ? 'text-blue-500' : '' }}">{{ $link['text'] }}</a>
                    </li>
                @empty
                    <li>No links provided.</li>
                @endforelse
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>
