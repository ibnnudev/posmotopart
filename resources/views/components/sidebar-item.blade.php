@props(['name' => '', 'icon' => '', 'route' => '', 'active' => false])

<li>
    <a {{ $route ? 'href=' . $route : '' }}
        class="flex items-center p-3 cursor-pointer text-sm rounded-md hover:bg-white hover:text-primary {{ $active == true ? 'bg-white text-primary ' : ' text-white' }}">
        <i class="{{ $icon }} w-4 h-4 transition duration-75"></i>
        <span class="ml-3">{{ $name }}</span>
    </a>
</li>
