<header class="w-full p-1 bg-white border-b px-4">
    <div class="flex justify-between">
        <div class="p-1 w-full"></div>
        <div class="p-1 w-full flex justify-end gap-2">
            {{-- cart --}}
            @auth
                <a type="button" href="{{ route('cart.index') }}"
                    class="hidden md:flex p-3 items-center font-normal text-gray-900 rounded-md dark:text-white hover:bg-gray-100 text-sm">
                    <i
                        class="fas fa-shopping-cart w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <div class="ml-3 flex gap-x-1 items-center">
                        Keranjang
                        @if (auth()->user()->carts->count() != 0)
                            <span
                                class="flex justify-center items-center w-4 h-4 rounded-full bg-yellow-500 text-white text-xs">{{ auth()->user()->carts->count() }}</span>
                        @endif
                    </div>
                </a>
            @endauth
            @auth
                <a href="{{ route('admin.dashboard') }}" class="flex justify-end gap-4 items-center">
                    <span class="ml-3 text-sm">{{ auth()->user()->name }}</span>
                    <img src="https://ui-avatars.com/api/?background=1D9A6C&color=fff&name={{ auth()->user()->name }}"
                        class="w-8 h-8 rounded-full" alt="avatar">
                </a>
            @endauth
            @guest
                <a href="{{ route('login') }}" type="button"
                    class="hidden md:flex items-center focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-1 dark:focus:ring-yellow-900">Masuk</a>
            @endguest
        </div>
    </div>
</header>
