@props(['comment'])

<x-panel class="bg-gray-50">
    <article class="flex space-x-4">
        <div class="flex-shrink-0">
            <x-post-avatar
                src="{{ $comment->author->image ? asset('storage/' . $comment->author->image) : asset('images/lary-head.svg') }}"
                onError="this.src='{{ asset('images/lary-head.svg') }}'" />
        </div>

        <div class="">
            <header class="mb-4">
                <h3 class="font-bold">{{ $comment->author->username }}</h3>
                <p class="">Posted
                    <time>{{ $comment->created_at->diffForHumans() }}</time>
                </p>
            </header>

            <p>
                {{ $comment->body }}
            </p>
        </div>
    </article>
</x-panel>
