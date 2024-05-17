<div class="md:flex">
    @role('admin')
        <a type="button" href="{{ route('admin.discount.edit', $id) }}"
            class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
            <i class="fas fa-edit w-3 h-3"></i>
        </a>
        <button onclick="btnDelete('{{ $id }}')"
            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4
        focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center
        dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
            <i class="fas fa-trash w-3 h-3"></i>
        </button>
    @endrole
    @role('seller')
        @if (!$isApplied)
            <form action="{{ route('admin.discount-store.apply', $id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Ikuti
                </button>
            </form>
        @else
            <form action="{{ route('admin.discount-store.remove', $id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4
focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center
dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                    <i class="fas fa-trash w-3 h-3"></i>
                </button>
            </form>
        @endif
    @endrole

</div>
