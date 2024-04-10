@auth
    <x-panel>
        <form action="/posts/{{ $post->slug }}/comments" method="post">
            @csrf

            <header class="flex items-center">
                <img src="https://i.pravatar.cc/40?u={{ auth()->id() }}" alt="" class="rounded-full">

                <h2 class="ml-4">Want to participate?</h2>
            </header>

            <x-form.field>
                <textarea name="body" class="w-full text-sm focus:outline-none focus:ring" rows="5"
                    placeholder="Quick, think of something to say!" required></textarea>

                <x-form.error name="body" />
            </x-form.field>

            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                <x-form.button>Comment</x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline hover:text-blue-500">Register</a> or <a href="/login"
            class="hover:underline hover:text-blue-500">Login</a> to leave
        a comment
    </p>
@endauth
