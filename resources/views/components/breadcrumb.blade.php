@props(['links' => []])

<div class="mb-4 text-sm">
    <p class="text-gray-500 bg-white p-4 rounded-lg">
        @foreach ($links as $link)
            @if ($loop->last)
                {{ $link['name'] }}
            @else
                <a href="{{ $link['url'] }}" class="text-primary">{{ $link['name'] }}</a> <span class="mx-1">/</span>
            @endif
        @endforeach
    </p>
</div>
