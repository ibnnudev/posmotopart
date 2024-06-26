@props([
    'label' => '',
    'name' => '',
    'required' => false,
    'tip' => '',
    'id' => '',
    'type' => 'text',
    'value' => '',
    'format' => '',
    'readonly' => false,
    'step' => false,
    'disabled' => false,
    'min' => '',
    'max' => '',
])
<div>
    <label class="block mb-2 text-sm font-normal text-gray-900 dark:text-white" for="{{ $id }}">
        {{ $label }} {!! $required ? '<span class="text-red-600">*</span>' : '' !!}
    </label>
    <input type="{{ $type }}" id="{{ $id }}" data-format="{{ $format }}"
        {{ $step ? 'step="any"' : '' }} {{ $disabled ? 'disabled' : '' }}
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-primary focus:border-primary transition duration-300 block w-full p-2.5"
        name="{{ $name }}" value="{{ $value }}" {{ $required != false ? 'required' : '' }}
        {{ $readonly ? 'readonly' : '' }} min="{{ $min }}" max="{{ $max }}" />
    @if ($tip)
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $tip }}</p>
    @endif
    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
