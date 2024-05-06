<label class="inline-flex items-center me-5 cursor-pointer">
    <input type="checkbox" value="" class="sr-only peer" {{ $data->status ? 'checked' : '' }}
        onclick="updateStatus({{ $data->id }}, this)">
    <div
        class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
    </div>
    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
        {{ $data->status ? 'Aktif' : 'Non Aktif' }}
    </span>
</label>
