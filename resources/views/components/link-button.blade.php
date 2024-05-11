@props(['href' => '#', 'title' => 'Button', 'primary' => false, 'id' => ''])

<a href="{{ $href }}" type="button" id="{{ $id }}"
    class="text-gray-900 {{ $primary ? 'bg-primary text-white' : 'bg-white' }} border border-gray-300 font-normal rounded-lg text-sm px-5 py-2.5 mb-2">{{ $title }}</a>
