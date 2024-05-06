@props(['id', 'label', 'name', 'required' => false, 'value' => ''])

<div>
    <label for="{{ $id }}" class="block mb-2 text-sm font-normal text-gray-900">
        {{ $label }} {!! $required ? '<span class="text-red-500">*</span>' : '' !!}
    </label>
    <textarea id="{{ $id }}" rows="4" name="{{ $name }}" {{ $required ? 'required' : '' }}
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition duration-300 ease-in-out">{{ $value }}</textarea>
</div>
