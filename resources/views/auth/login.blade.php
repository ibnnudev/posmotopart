<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <section class="flex justify-center items-center h-screen">
            <div class="px-8 py-24 mx-auto md:px-12 lg:px-32 max-w-7xl">
                <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-24">
                    <div class="flex flex-col">
                        <h1 class="text-4xl font-semibold tracking-tighter leading-none text-gray-900 lg:text-5xl">
                            Menyediakan layanan <span class="text-primary">terbaik</span> untuk <span
                                class="text-primary">semua</span> orang
                        </h1>
                        <p class="mt-4 text-sm font-medium text-gray-500 text-pretty">
                            Belanja kebutuhan lengkap dengan harga terjangkau, kualitas terbaik, dan pelayanan yang
                            memuaskan.
                        </p>
                    </div>
                    <div class="p-2 border bg-gray-50 rounded-3xl">
                        <div class="p-10 bg-white border shadow-lg rounded-2xl">
                            <form>
                                <div class="space-y-3">
                                    <div>
                                        <label for="email" class="block mb-3 text-sm font-medium text-black">
                                            Email
                                        </label>
                                        <input type="email" id="email" name="email"
                                            class="block w-full h-12 px-4 py-2 text-primary duration-200 border rounded-lg appearance-none bg-chalk border-zinc-300 placeholder-zinc-300 focus:border-zinc-300 focus:outline-none focus:ring-zinc-300 sm:text-sm">
                                    </div>
                                    <div class="col-span-full">
                                        <label for="password" class="block mb-3 text-sm font-medium text-black">
                                            Kata sandi
                                        </label>
                                        <input id="password" name="password"
                                            class="block w-full h-12 px-4 py-2 text-primary duration-200 border rounded-lg appearance-none bg-chalk border-zinc-300 placeholder-zinc-300 focus:border-zinc-300 focus:outline-none focus:ring-zinc-300 sm:text-sm"
                                            type="password">
                                    </div>
                                    <div class="col-span-full">
                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-full h-12 gap-3 px-5 py-3 font-normal text-white duration-200 bg-primary rounded-xl focus:ring-2 focus:ring-offset-2 focus:ring-black">
                                            Masuk
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <p class="flex mx-auto text-sm font-medium leading-tight text-center text-black">
                                        Tidak punya akun?
                                        <a class="ml-auto text-primary hover:text-black" href="{{ route('register') }}">
                                            Daftar sekarang
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</x-guest-layout>
