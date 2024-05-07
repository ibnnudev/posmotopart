@props(['href' => '#', 'title' => 'Button', 'primary' => false])

<a href="{{ $href }}" type="button"
    class="text-gray-900 {{ $primary ? 'bg-primary text-white' : 'bg-white' }} border border-gray-300 font-normal rounded-lg text-sm px-5 py-2.5 mb-2">{{ $title }}</a>
