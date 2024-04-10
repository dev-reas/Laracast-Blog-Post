@if (session()->has('success'))
    <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 4000)" x-show="open" x-transition.duration.500ms
        class="fixed bottom-3 right-3 bg-blue-500 text-white py-2 px-4 rounded-xl text-sm">
        <p>
            {{ session('success') }}
        </p>
    </div>
@endif
