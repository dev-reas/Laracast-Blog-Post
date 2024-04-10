@props(['src', 'onError'])

<img src="{{ $src }}" alt="No image found" onerror="{{ $onError }}" class="rounded-xl">
