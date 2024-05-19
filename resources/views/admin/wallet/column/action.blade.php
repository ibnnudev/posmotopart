<div class="md:flex">
    @if ($status == 'Approved' || $status == 'Rejected')
        <button type="button"
            class="text-gray-400 bg-gray-200 cursor-not-allowed font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-gray-700 dark:text-gray-500 dark:border-gray-500"
            disabled>
            <i class="fas fa-edit w-3 h-3"></i>
        </button>
    @else
        <a href="{{ route('admin.wallet.edit', $id) }}"
            class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
            <i class="fas fa-edit w-3 h-3"></i>
        </a>
    @endif
</div>
