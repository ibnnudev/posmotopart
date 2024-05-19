@switch($data->status)
    @case('process_by_merchant')
        <span
            class="bg-gray-100 text-gray-800 text-xs capitalize me-2 px-2.5 py-0.5 rounded font-medium dark:bg-gray-700 dark:text-gray-300">
            Diproses oleh penjual
        </span>
    @break

    @case('admin_confirmation')
        <span
            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
            Konfirmasi admin
        </span>
    @break

    @case('shipping')
        <span
            class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">
            Pengiriman
        </span>
    @break

    @default
@endswitch
