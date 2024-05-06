<div class="md:flex">
    <a type="button" href="{{ route('admin.store.edit', $id) }}"
        class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
        <i class="fas fa-edit w-3 h-3"></i>
    </a>
    <button onclick="btnDelete('{{ $id }}')"
        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4
        focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center
        dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
        <i class="fas fa-trash w-3 h-3"></i>
    </button>
</div>
