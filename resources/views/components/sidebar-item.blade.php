@props(['name' => '', 'icon' => '', 'route' => '', 'active' => false])

<li>
    <a href="{{ $route }}"
        class="flex items-center p-3 font-light text-sm rounded-md hover:bg-white hover:text-primary {{ $active == true ? 'bg-white text-primary ' : ' text-white' }}">
        <i class="{{ $icon }} w-4 h-4 transition duration-75"></i>
        <span class="ml-3">{{ $name }}</span>
    </a>
</li>
