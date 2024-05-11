<header class="w-full p-1 bg-white border-b px-4">
    <div class="flex justify-between">
        <div class="p-1 w-full"></div>
        <div class="p-1 w-full flex justify-end gap-2">
            @auth
                <div class="flex justify-end gap-4 items-center">
                    <span class="ml-3">{{ auth()->user()->name }}</span>
                    <img src="https://ui-avatars.com/api/?background=1D9A6C&color=fff&name={{ auth()->user()->name }}"
                        class="w-8 h-8 rounded-full" alt="avatar">
                </div>
            @endauth
            {{-- cart --}}
            <a type="button" href=""
                class="hidden md:block p-3 font-normal text-gray-900 rounded-md dark:text-white hover:bg-gray-100 text-sm">
                <i
                    class="fas fa-shopping-cart w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                <span class="ml-3">Keranjang</span>
            </a>
            <a href="{{ route('login') }}" type="button"
                class="hidden md:flex items-center focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-1 dark:focus:ring-yellow-900">Masuk</a>
        </div>
    </div>
</header>
