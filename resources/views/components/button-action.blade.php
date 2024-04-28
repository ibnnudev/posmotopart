@props(['route' => '#', 'color' => '', 'id' => '', 'target' => '_self'])

<a href="{{ $route }}" {!! $attributes->merge([
    'class' =>
    'focus:outline-none text-white font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-' .
    $color .
    '-500 hover:bg-' .
    $color .
    '-600 focus:bg-' .
    $color .
    '-600 active:bg-' .
    $color .
    '-900 focus:outline-none focus:ring-2 focus:ring-' .
    $color .
    '-500',
]) !!} id="{{ $id }}"
    target="{{ $target }}">{{ $slot }}</a>