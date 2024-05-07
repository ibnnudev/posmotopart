@props(['id' => null, 'type' => 'button', 'class' => '', 'fit' => false, 'onclick' => null])
<button type="{{ $type }}" id="{{ $id }}" onclick="{{ $onclick }}"
    class="focus:outline-none {{ $fit ? 'w-fit' : 'w-full' }} text-white bg-primary hover:bg-opacity-80 transition duration-300 ease-in-out font-normal rounded-lg text-sm py-2.5 px-5 mb-2 {{ $class }}">
    {{ $slot }}
</button>
