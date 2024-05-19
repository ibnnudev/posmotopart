@switch($data->status)
    @case('process_by_merchant')
        <span
            class="bg-gray-100 text-gray-800 text-xs capitalize me-2 px-2.5 py-0.5 rounded font-medium dark:bg-gray-700 dark:text-gray-300">
            Diproses oleh penjual
        </span>
    @break

    @case('waiting_confirmation')
        <span
            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
            Menunggu Konfirmasi
        </span>
    @break

    @case('user_confirm')
        <span
            class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
            Menunggu Pembayaran
        </span>
    @break

    @case('admin_confirm')
        <span
            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
            Pembayaran Diverifikasi
        </span>
    @break

    @case('shipping')
        <span
            class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">
            <i class="fas fa-truck me-1"></i> Sedang Dikirim
        </span>
    @break

    @case('admin_reject')
        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
            Transaksi Ditolak
        </span>
    @break

    @case('done')
        <span
            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
            Selesai
        </span>
    @break

    @case('user_reject')
        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
            Dibatalkan oleh buyer
        </span>
    @break

    @default
@endswitch
