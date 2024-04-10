@props(['src', 'onError'])

<img src="{{ $src }}" alt="No Image Found" onerror="{{ $onError }}"
    class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0 object-contain">
