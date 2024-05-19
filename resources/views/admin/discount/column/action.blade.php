<div class="md:flex">
    @role('admin')
        <a type="button" href="{{ route('admin.discount.edit', $data->id) }}"
            class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
            <i class="fas fa-edit w-3 h-3"></i>
        </a>
        <button onclick="btnDelete('{{ $data->id }}')"
            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4
        focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center
        dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
            <i class="fas fa-trash w-3 h-3"></i>
        </button>
        <a type="button" href="{{ route('admin.discount.show', $data->id) }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center ml-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fas fa-eye w-3 h-3"></i>
        </a>
    @endrole
    @role('seller')
        @if ($data->end_date > date('Y-m-d'))
            @if (!$isApplied)
                <form action="{{ route('admin.discount-store.apply', $data->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Ikuti
                    </button>
                </form>
            @else
                <form action="{{ route('admin.discount-store.remove', $data->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit"
                        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4
focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center
dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                        <i class="fas fa-trash w-3 h-3"></i>
                    </button>
                </form>
            @endif
        @else
            <a type="button" class="text-gray-400 font-medium text-sm text-center me-2 mb-2" disabled>Event
                Berakhir</a>
        @endif
    @endrole

</div>
