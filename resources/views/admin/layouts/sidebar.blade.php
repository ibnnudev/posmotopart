<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen border border-primary border-r transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-4 py-8 overflow-y-auto bg-primary">
        <ul class="space-y-2">
            <x-sidebar-item name="Dashboard" icon="fas fa-home" route="{{ route('admin.dashboard') }}"
                active="{{ request()->routeIs('admin.dashboard') }}" />
            <li class="flex items-center justify-between px-3 py-2 font-normal text-xs text-white uppercase rounded-md">
                <span>Master Data</span>
            </li>
            <x-sidebar-item name="Daftar Toko" icon="fas fa-store" route="{{ route('admin.store.index') }}"
                active="{{ request()->routeIs('admin.store.*') }}" />
            <x-sidebar-item name="Kategori" icon="fas fa-list" route="{{ route('admin.category.index') }}"
                active="{{ request()->routeIs('admin.category.*') }}" />
            <x-sidebar-item name="Metode Pembayaran" icon="fas fa-credit-card"
                route="{{ route('admin.payment-option.index') }}"
                active="{{ request()->routeIs('admin.payment-option.*') }}" />
            <li class="flex items-center justify-between px-3 py-2 font-normal text-xs text-white uppercase rounded-md">
                <span>Pengaturan</span>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center p-3 text-sm font-light text-white rounded-md  hover:bg-gray-100 hover:text-primary">
                        <i class="fas fa-sign-out-alt w-4 h-4 transition duration-75 hover:text-primary"></i>
                        <span class="ml-3">Keluar</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
