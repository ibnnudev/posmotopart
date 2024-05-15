@props(['links' => []])

<div class="mb-4 text-sm {{ // check if ther's admin in route
    request()->routeIs('admin.*') ? '' : 'mb-8' }}">
    <p class="text-gray-500 bg-primary p-4 rounded-lg">
        @foreach ($links as $link)
            @if ($loop->last)
                <span class="text-white">{{ $link['name'] }}</span>
            @else
                <a href="{{ $link['url'] }}" class="text-primary bg-white px-2 py-1 rounded-md">{{ $link['name'] }}</a>
                <span class="mx-1 text-white">/</span>
            @endif
        @endforeach
    </p>
</div>
