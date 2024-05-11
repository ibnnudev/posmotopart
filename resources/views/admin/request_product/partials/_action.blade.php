<div class="lg:flex gap-x-2">
    @role('admin')
        <a type="button" href="{{ route('admin.request-product.change-status-form', $data->id) }}"
            class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
            <i class="fas fa-check"></i>
        </a>
    @endrole

    @role('seller')
        <a type="button" href="{{ route('admin.request-product.edit', $data->id) }}"
            class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
            <i class="fas fa-edit"></i>
        </a>
    @endrole
</div>
