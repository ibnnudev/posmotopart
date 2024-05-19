@props(['active' => false, 'title' => '', 'icon' => '', 'toggle' => ''])
<li class="text-sm">
    <button type="button" class="flex w-full items-center px-3 py-3 rounded-md text-white"
        aria-controls="{{ $toggle }}" data-collapse-toggle="{{ $toggle }}">
        <i
            class="{{ $icon }} w-4 h-4 text-white transition duration-75 dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"></i>
        <span class="ml-3">{{ $title }}</span>
        </span>
        <i class="fas {{ $active ? 'fa-chevron-up' : 'fa-chevron-down' }} ml-auto"></i>
    </button>
    <ul id="{{ $toggle }}" class="{{ $active ? 'block' : 'hidden' }} space-y-2">
        {{ $slot }}
    </ul>
</li>
