@props(['posts'])
<article class="flex items-start justify-between space-x-6 p-5 hover:bg-gray-100 rounded-xl">
    <div class="w-64">
        <img src="{{ asset('storage/' . $posts->thumbnail) }}" alt="No image found"
            onerror="this.src='/images/illustration-1.png'" class="rounded-xl w-full">
    </div>
    <div class="flex-1">
        <div class="flex items-center gap-x-4 text-xs">
            <span class="mt-2 block text-gray-400 text-xs">
                Published <time>{{ $posts->created_at->diffForHumans() }}</time>
            </span>
            <x-category-button :category="$posts->category" />
        </div>
        <div class="group relative">
            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                <p>
                    <span class="absolute inset-0"></span>
                    {{ $posts->title }}
                </p>
            </h3>
            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ $posts->excerpt }}</p>
        </div>
        <footer class="flex justify-between items-center mt-8">
            <div class="flex items-center text-sm">
                <img src="/images/lary-avatar.svg" alt="Lary avatar">
                <div class="ml-3">
                    <a href="/?author={{ $posts->author->username }}">
                        <h5 class="font-bold">{{ $posts->author->name }}</h5>
                    </a>
                </div>
            </div>

            <div>
                <a href="/posts/{{ $posts->slug }}"
                    class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">Read
                    More</a>
            </div>
        </footer>

    </div>
</article>
