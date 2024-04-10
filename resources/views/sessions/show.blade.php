<x-layout>
    <main class="mt-5">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                <div class="col-span-4 sm:col-span-3">
                    <div class="border border-gray-100 shadow rounded-lg p-6">
                        <div class="flex flex-col items-center">
                            <x-user-avatar
                                src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/lary-head.svg') }}"
                                onError="this.src='{{ asset('images/lary-head.svg') }}'" />
                            <h1 class="text-xl font-bold">{{ $user->name }}</h1>
                            <div class="my-3 pt-3">
                                @auth
                                    @if (auth()->id() === $user->id)
                                        <a href="/{{ auth()->user()->username }}/settings"
                                            class="p-2 border-2 border-blue-500 rounded-xl font-semibold 
                                    hover:text-gray-800 hover:bg-blue-200 hover:border-blue-200">Edit</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 sm:col-span-9">
                    <div class="bg-white">
                        <div class="mx-auto max-w-7xl px-6 lg:px-8">
                            <div class="mx-auto max-w-2xl lg:mx-0">
                                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">My Blog
                                    posts</h2>
                            </div>
                            <div
                                class="border-gray-200 border-t gap-x-8 gap-y-4 grid grid-cols-1 lg:max-w-none lg:mx-0 max-w-2xl mt-10 mx-auto pt-10">
                                @if ($user->posts->count() > 0)
                                    @foreach ($posts as $post)
                                        <x-post-card-account :posts="$post" />
                                    @endforeach

                                    {{ $posts->links() }}
                                @else
                                    <p class="px-5">No posts yet recorded from {{ $user->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
