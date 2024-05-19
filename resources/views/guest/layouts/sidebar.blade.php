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
            <x-sidebar-item name="Belanja" icon="fas fa-shopping-cart" route="{{ route('product-category.index') }}"
                active="{{ request()->routeIs('product-category.index') ||
                    request()->routeIs('product-category.index') ||
                    request()->routeIs('product-category.show') ||
                    request()->routeIs('product-category.products') ||
                    request()->routeIs('home') ||
                    request()->routeIs('cart.*') ||
                    request()->routeIs('checkout.*') }}" />
            @auth
                <x-sidebar-dropdown title="Riwayat Transaksi" icon="fas fa-poll-h" toggle="transaction"
                    active="{{ request()->routeIs('transaction.*') }}">
                    <x-sidebar-submenu name="Semua" route="{{ route('transaction.index') }}"
                        active="{{ request()->routeIs('transaction.index') }}" icon="fas fa-list" />
                </x-sidebar-dropdown>
                <x-sidebar-item name="Profil" icon="fas fa-user" route="{{ route('admin.profile.index') }}"
                    active="{{ request()->routeIs('admin.profile.*') }}" />
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center p-3 text-sm text-white rounded-md  hover:bg-gray-100 hover:text-primary">
                            <i class="fas fa-sign-out-alt w-4 h-4 transition duration-75 hover:text-primary"></i>
                            <span class="ml-3">Keluar</span>
                        </button>
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</aside>
