@props([
    'id' => '',
    'label' => '',
    'name' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'multiple' => false,
])

<div>
    <label class="block text-sm mb-2">
        {{ $label }} {!! $required ? '<span class="text-red-500">*</span>' : '' !!}
    </label>
    <div>
        <select id="{{ $id }}" name="{{ $name }}" {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }} {{ $multiple ? 'multiple="multiple"' : '' }}
            class="block w-full py-2.5 pl-3 pr-10 text-base bg-gray-50 border-gray-300 focus:outline-none focus:ring-primary focus:border-primary text-sm rounded-md select-input">
            {{ $slot }}
        </select>
    </div>
</div>
