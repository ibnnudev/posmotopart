<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Laporan Penjualan', 'url' => ''],
        ['name' => 'Detail', 'url' => ''],
    ]" />

    {{-- <div id="alert-additional-content-4"
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
    </div> --}}
    <div class="py-2">
        <div class="mx-auto">
            <div class="bg-white border border-gray-100 shadow-sm overflow-hidden sm:rounded-2xl">
                <div class="p-4">
                    <div class="grid grid-cols-4 mb-2 gap-6">
                        <div>
                            <p class="font-medium text-gray-500 mb-1">Nama Pembeli</p>
                            <p>{{ $customer->name }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 mb-1">Tanggal Pesan</p>
                            <p>{{ $transaction->created_at->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 mb-1">Status</p>
                            @switch($transaction->status)
                                @case('process_by_merchant')
                                    <p class="text-yellow-500">Diproses oleh Penjual</p>
                                @break

                                @case('user_confirm')
                                    <p class="text-yellow-500">Konfirmasi Pembeli</p>
                                @break

                                @case('shipping')
                                    <p class="text-yellow-500">Dikirim</p>
                                @break

                                @case('done')
                                    <p class="text-green-500">Selesai</p>
                                @break

                                @default
                            @endswitch
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 mb-1">No Telepon</p>
                            <p>{{ $customer->phone }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 mb-1">Alamat</p>
                            <p>{{ $transaction->destinationOrder->address }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 mb-1">Kota</p>
                            <p>{{ $transaction->destinationOrder->regency }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 mb-1">Kecamatan</p>
                            <p>{{ $transaction->destinationOrder->district }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 mb-1">Provinsi</p>
                            <p>{{ $transaction->destinationOrder->province }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 mb-1">Admin Fee</p>
                            <p>Rp {{ number_format($transaction->admin_fee) }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 mb-1">Tanggal Pengiriman</p>
                            <p>{{ $transaction->shipping_date ? $transaction->shipping_date->locale('id')->isoFormat('dddd, D MMMM Y') : '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-500 mb-1">Metode Pembayaran</p>
                            <p>
                                {{ $transaction->paymentOption->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-card-container>
            <div class="grid lg:grid-cols-4 gap-6">
                <div>
                    <p class="font-medium text-gray-500 mb-2">Bukti Pembayaran</p>
                    @if ($transaction->payment_proof != null)
                        <a class="text-primary underline"
                            href="{{ asset('storage/payment-proof/' . $transaction->payment_proof) }}"
                            target="_blank">Lihat
                            Bukti
                            Pembayaran</a>
                    @endif
                </div>
                @role('seller')
                    <div class="">
                        @if (
                            $transaction->status == 'waiting_confirmation' ||
                                ($transaction->status == 'user_confirm' && $transaction->paymentOption->name != 'Paylater'))
                            <p class="font-medium text-gray-500 mb-2">Ubah Status Bukti Pembayaran</p>
                            <form action="{{ route('admin.transaction.verification-payment', $transaction->id) }}"
                                method="POST">
                                @csrf
                                <x-button type="submit" fit id="verify_payment_proof"
                                    class="bg-primary text-white">Verifikasi
                                    Bukti Pembayaran</x-button>
                            </form>
                        @endif

                        @if ($transaction->status == 'admin_confirm')
                            <p class="font-medium text-gray-500 mb-2">Status Bukti Pembayaran</p>
                            <p class="text-green-500">Terverifikasi</p>
                        @endif
                    </div>
                @endrole
                @if (
                    $transaction->status == 'done' ||
                        $transaction->status == 'admin_reject' ||
                        $transaction->status == 'shipping' ||
                        $transaction->status == 'user_reject')
                    <div>
                        <p class="font-medium text-gray-500 mb-2">Status Transaksi</p>
                        @include('admin.transaction.status', ['data' => $transaction])
                    </div>
                @else
                    @role('seller')
                        <x-select id="change_status" name="change_status" label="Ubah Status">
                            <option value="">Pilih Status</option>
                            <option value="process_by_merchant"
                                {{ $transaction->status == 'process_by_merchant' || $transaction->status == 'waiting_confirmation' ? 'selected' : '' }}>
                                Diproses oleh
                                Penjual</option>
                            <option value="user_confirm" {{ $transaction->status == 'user_confirm' ? 'selected' : '' }}>
                                Konfirmasi Pembeli
                            </option>
                            <option value="shipping" {{ $transaction->status == 'shipping' ? 'selected' : '' }}>
                                Dikirim</option>
                            {{-- <option value="done" {{ $transaction->status == 'done' ? 'selected' : '' }}>Selesai
                        </option> --}}
                            <option value="admin_reject" {{ $transaction->status == 'admin_reject' ? 'selected' : '' }}>
                                Ditolak
                            </option>
                        </x-select>
                    @endrole
                @endif
            </div>
        </x-card-container>

        <form action="{{ route('admin.transaction.confirm-order', $transaction->id) }}" method="POST">
            @csrf
            <x-card-container>
                <div class="grid grid-cols-6 py-5 text-gray-500">
                    <p class="font-medium">Nama Produk</p>
                    <p class="font-medium">SKU</p>
                    <p class="font-medium">Jumlah Diminta</p>
                    <p class="font-medium">Jumlah Ditolak</p>
                    <p class="font-medium">Total Harga</p>
                    <p></p>
                </div>
                @foreach ($transactions as $item)
                    <div class="grid grid-cols-6 py-5 items-center">
                        <p>{{ $item->product->name }}</p>
                        <p>{{ $item->product->SKU }}</p>
                        <p>{{ $item->requested_qty }}</p>
                        <p>{{ $item->rejected_qty }}</p>
                        <p>Rp {{ number_format($item->total_price) }}</p>
                        <div
                            class="{{ $transaction->status == 'done' ||
                            $transaction->status == 'admin_reject' ||
                            $transaction->status == 'shipping' ||
                            $transaction->status == 'user_reject'
                                ? 'hidden'
                                : '' }}">
                            <input type="number" id="reject-qty-{{ $item->id }}"
                                name="rejected[{{ $item->id }}]" value="{{ $item->rejected_qty ?? '0' }}"
                                min="0" oninput="rejectQty({{ $item->id }}, {{ $item->requested_qty }})"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="Jumlah Ditolak" />
                        </div>
                    </div>
                @endforeach
            </x-card-container>
            @role('seller')
                @if ($transaction->status == 'process_by_merchant')
                    <x-footer-form title="Simpan Perubahan" :backButton="false" :isLeft="false" />
                @endrole
        </form>
        @endif

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

                $('#change_status').change(function(e) {
                    e.preventDefault();
                    const status = $(this).val();
                    let transactionId = @json($transaction->id);
                    let currentStatus = @json($transaction->status);
                    if (status == '' || status == currentStatus) {
                        return;
                    }
                    Swal.fire({
                        title: 'Ubah Status Pesanan',
                        text: 'Apakah Anda yakin ingin mengubah status pesanan menjadi ' + status + '?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Ubah Status!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('admin.transaction.change-status', ':id') }}"
                                    .replace(':id', transactionId),
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    status: status,
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Status pesanan berhasil diubah',
                                        icon: 'success',
                                    }).then(() => {
                                        location.reload();
                                    });
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Status pesanan gagal diubah',
                                        icon: 'error',
                                    });
                                },
                            });
                        }
                    });
                });

                $('#verify_payment_proof').click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Verifikasi Bukti Pembayaran',
                        text: 'Apakah Anda yakin ingin memverifikasi bukti pembayaran?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Verifikasi!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#verify_payment_proof').closest('form').submit();
                        }
                    });
                });
            </script>
        @endpush
</x-app-layout>
