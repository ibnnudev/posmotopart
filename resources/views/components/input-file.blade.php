@props(['id', 'label', 'name', 'value' => null, 'required' => false])

<div>
    <label class="block mb-2 text-sm font-normal text-gray-900 dark:text-white" for="{{ $id }}">
        {{ $label }} {!! $required ? '<span class="text-red-500">*</span>' : '' !!}
    </label>
    <input
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        id="{{ $id }}" type="file" name="{{ $name }}" {{ $required ? 'required' : '' }} />
    @if ($value)
        <small class="text-gray-500 mt-2 block">
            Kosongkan jika tidak ingin mengubah file
        </small>
    @endif
</div>
