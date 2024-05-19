<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Laporan Penjualan', 'url' => ''],
        ['name' => 'Proses Oleh Merchant', 'url' => route('admin.transaction.process-by-merchant')],
    ]" />

    <div id="alert-additional-content-4"
        class="p-4 mb-4 text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
        role="alert">
        <div class="flex items-center">
            <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <h3 class="text-lg font-medium">Perhatian</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            Ketika Anda menekan tombol "Konfirmasi Pesanan", maka pesanan akan dikonfirmasi dan tidak dapat diubah lagi.
            Dan buyer akan mendapatkan notifikasi bahwa pesanan perlu dilakukan pembayaran
        </div>
        <div class="flex">
            <button type="button"
                class="text-yellow-800 bg-transparent border border-yellow-800 hover:bg-yellow-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-yellow-300 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-gray-800 dark:focus:ring-yellow-800"
                data-dismiss-target="#alert-additional-content-4" aria-label="Close">
                Tutup
            </button>
        </div>
    </div>
    <div class="py-2">
        <div class="mx-auto">
            <div class="bg-white border border-gray-100 shadow-sm overflow-hidden sm:rounded-2xl">
                <div class="p-4">
                    <div class="grid grid-cols-6 mb-2">
                        <p class="font-medium text-gray-500">Nama Pembeli</p>
                        <p class="font-medium text-gray-500">Tanggal Pesan</p>
                        <p class="font-medium text-gray-500">Status</p>
                    </div>
                    <div class="grid grid-cols-6 items-start">
                        <p>{{ $customer->name }}</p>
                        <p>{{ $transaction->created_at->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                        @include('admin.transaction.status', ['data' => $transaction])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.transaction.change-status', $transaction->id) }}" method="POST">
        @csrf
        @foreach ($transactions as $key => $val)
            <x-card-container>
                <p class="uppercase font-medium mb-3 pb-2 border-b border-b-gray-200">{{ $key }}</p>
                <div class="grid grid-cols-6 py-5 text-gray-500">
                    <p class="font-medium">Nama Produk</p>
                    <p class="font-medium">SKU</p>
                    <p class="font-medium">Jumlah Diminta</p>
                    <p class="font-medium">Jumlah Ditolak</p>
                    <p class="font-medium">Total Harga</p>
                    <p></p>
                </div>
                @foreach ($val as $item)
                    <div class="grid grid-cols-6 py-5 items-center">
                        <p>{{ $item->product->name }}</p>
                        <p>{{ $item->product->SKU }}</p>
                        <p>{{ $item->requested_qty }}</p>
                        <p>{{ $item->rejected_qty }}</p>
                        <p>Rp {{ number_format($item->total_price) }}</p>
                        <div>
                            <input type="number" id="reject-qty-{{ $item->id }}"
                                name="reject-qty-{{ $item->id }}"
                                oninput="rejectQty({{ $item->id }}, {{ $item->requested_qty }})"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="Jumlah Ditolak" />
                        </div>
                    </div>
                @endforeach
            </x-card-container>
        @endforeach
        <x-footer-form title="Konfirmasi Pesanan oleh Admin" :backButton="false" :isLeft="false" />
    </form>
    @push('js-internal')
        <script>
            function rejectQty(id, requested) {
                const rejectQty = $('#reject-qty-' + id).val();
                if (rejectQty > requested) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Jumlah yang ditolak melebihi jumlah yang diminta!',
                    });
                    $('#reject-qty-' + id).val('');
                }
            }

            $('button[type="submit"]').on('click', function() {

            });
        </script>
    @endpush
</x-app-layout>
