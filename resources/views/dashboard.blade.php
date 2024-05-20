<x-app-layout>
    <div class="grid gap-4 grid-cols-5 justify-around mb-4 text-sm">
        {{-- Jumlah Order Diproses  --}}
        <x-card-container>
            <div class="flex justify-between pb-2">
                <div>
                    <h5 class="leading-none text-lg font-bold text-gray-900 dark:text-white pb-2">
                        {{ $jumlahTransactionDetail }} <span class="text-sm">pcs</span>
                    </h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Jumlah Order Diproses</p>
                </div>
                <div
                    class="flex items-center px-2.5 py-0.5 text-sm font-semibold text-green-500 dark:text-green-500 text-center">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
            <div class="grid grid-cols-1 items-center border-gray-200 dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                    <a href="{{ route('admin.transaction.index') }}"
                        class="capitalize text-sm font-semibold inline-flex items-center rounded-lg text-green-600 hover:text-green-700 dark:hover:text-green-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 py-2">
                        Detail Transaksi
                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </div>
        </x-card-container>
        {{-- End Jumlah Order Diproses --}}
        {{-- Total Order Diproses --}}
        <x-card-container>
            <div class="flex justify-between pb-2">
                <div>
                    <h5 class="leading-none text-lg font-bold text-gray-900 dark:text-white pb-2">
                        <span class="text-sm">Rp. </span> {{ $totalTransactionDetail }}
                    </h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Jumlah Order Diproses</p>
                </div>
                <div
                    class="flex items-center px-2.5 py-0.5 text-sm font-semibold text-green-500 dark:text-green-500 text-center">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <div class="grid grid-cols-1 items-center border-gray-200 dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                    <a href="{{ route('admin.transaction.index') }}"
                        class="capitalize text-sm font-semibold inline-flex items-center rounded-lg text-green-600 hover:text-green-700 dark:hover:text-green-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 py-2">
                        Detail Transaksi
                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </div>
        </x-card-container>
        {{-- End Total Order Diproses --}}
        {{-- Jumlah Barang Ditolak --}}
        <x-card-container>
            <div class="flex justify-between pb-2">
                <div>
                    <h5 class="leading-none text-lg font-bold text-gray-900 dark:text-white pb-2">
                        {{ $totalRejectTransaction }}
                    </h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Jumlah Barang Ditolak</p>
                </div>
                <div
                    class="flex items-center px-2.5 py-0.5 text-sm font-semibold text-green-500 dark:text-green-500 text-center">
                    <i class="fas fa-object-group"></i>
                </div>
            </div>
            <div class="grid grid-cols-1 items-center border-gray-200 dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                    <a href="{{ route('admin.transaction.index') }}"
                        class="capitalize text-sm font-semibold inline-flex items-center rounded-lg text-green-600 hover:text-green-700 dark:hover:text-green-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 py-2">
                        Detail Transaksi
                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </div>
        </x-card-container>
        {{-- End Jumlah Barang ditolak --}}
        {{-- SKU Nol --}}
        <x-card-container>
            <div class="flex justify-between pb-2">
                <div>
                    <h5 class="leading-none text-lg font-bold text-gray-900 dark:text-white pb-2">
                        {{ $jumlahSkuNull }}
                    </h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Jumlah SKU Kosong</p>
                </div>
                <div
                    class="flex items-center px-2.5 py-0.5 text-sm font-semibold text-green-500 dark:text-green-500 text-center">
                    <i class="fas fa-panorama"></i>
                </div>
            </div>
            <div class="grid grid-cols-1 items-center border-gray-200 dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                    <a href="{{ route('admin.product.index') }}"
                        class="capitalize text-sm font-semibold inline-flex items-center rounded-lg text-green-600 hover:text-green-700 dark:hover:text-green-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 py-2">
                        Product Detail
                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </div>
        </x-card-container>
        {{-- End Jumlah Barang ditolak --}}
        {{-- Barang Ditolak --}}
        <x-card-container>
            <div class="flex justify-between pb-2">
                <div>
                    <h5 class="leading-none text-lg font-bold text-gray-900 dark:text-white pb-2">
                        {{ $jumlahBarangDitolak }}
                    </h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total Order Ditolak</p>
                </div>
                <div
                    class="flex items-center px-2.5 py-0.5 text-sm font-semibold text-green-500 dark:text-green-500 text-center">
                    <i class="fas fa-redo"></i>
                </div>
            </div>
            <div class="grid grid-cols-1 items-center border-gray-200 dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                    <a href="{{ route('admin.request-product.index') }}"
                        class="capitalize text-sm font-semibold inline-flex items-center rounded-lg text-green-600 hover:text-green-700 dark:hover:text-green-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 py-2">
                        Pengajuan Produk
                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </div>
        </x-card-container>
        {{-- End Jumlah Barang ditolak --}}
    </div>
    {{-- <div class="max-w-9xl w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                        <path
                            d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                        <path
                            d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                    </svg>
                </div>
                <div>
                    <h5 class="leading-none text-lg font-bold text-gray-900 dark:text-white pb-1">3.4k</h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Leads generated per week</p>
                </div>
            </div>
            <div>
                <span
                    class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                    42.5%
                </span>
            </div>
        </div>

        <div class="grid grid-cols-2">
            <dl class="flex items-center">
                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Money spent:</dt>
                <dd class="text-gray-900 text-sm dark:text-white font-semibold">$3,232</dd>
            </dl>
            <dl class="flex items-center justify-end">
                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Conversion rate:</dt>
                <dd class="text-gray-900 text-sm dark:text-white font-semibold">1.2%</dd>
            </dl>
        </div>

        <div id="column-chart"></div>

    </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @push('js-internal')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const chartData = @json($data);
                console.log(chartData);
                const options = {
                    colors: chartData.colors,
                    series: chartData.series.map((item) => ({
                        name: item.name,
                        color: item.color,
                        data: item.data.
                    }))
                };
                if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("column-chart"), options);
                    chart.render();
                }

            })
        </script>
    @endpush


</x-app-layout>
