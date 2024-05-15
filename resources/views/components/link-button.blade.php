@props([
    'href' => '#',
    'title' => 'Button',
    'primary' => false,
    'id' => '',
    'icon' => '',
    'class' => '',
    'onclick' => '',
])

<a href="{{ $href }}" type="button" id="{{ $id }}" onclick="{{ $onclick }}"
    class="text-gray-900 {{ $primary ? 'bg-primary text-white' : 'bg-white' }} border border-gray-300 font-normal rounded-lg text-sm px-5 py-2.5 mb-2 inline-block {{ $class }}">
    {!! $icon ? '<i class="' . $icon . '"></i>' : '' !!}
    {{ $title }}
</a>
