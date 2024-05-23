<x-guest-layout>
    <x-breadcrumb :links="[['name' => 'Riwayat Transaksi', 'url' => route('transaction.index')]]" />

    @forelse ($transactionDetails as $data)
        <div id="accordion-flush-{{ $data->id }}" data-accordion="collapse" class="bg-primary mb-6"
            data-active-classes="bg-primary text-white" data-inactive-classes="text-white bg-primary">
            <h2 id="accordion-flush-heading-{{ $data->id }}">
                <button type="button"
                    class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-white bg-primary gap-3 px-6"
                    data-accordion-target="#accordion-flush-body-{{ $data->id }}" aria-expanded="true"
                    aria-controls="accordion-flush-body-{{ $data->id }}">
                    <div class="space-y-2 text-start text-white text-sm">
                        <span class="">
                            Kode Transaksi: {{ $data->transaction_code }}
                        </span>
                        <p class="font-normal">
                            {{ $data->created_at->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                        </p>
                    </div>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-{{ $data->id }}" class="hidden p-6 bg-white"
                aria-labelledby="accordion-flush-heading-{{ $data->id }}">

                <div class="grid grid-cols-5 items-center text-sm font-medium text-gray-400 gap-6">
                    <p>Produk</p>
                    <p>SKU</p>
                    <p>Jumlah Diminta</p>
                    <p>Jumlah Ditolak</p>
                    <p>Total Harga</p>
                </div>
                @foreach ($data->transactions as $item)
                    <div class="grid grid-cols-5 py-5 items-start text-sm gap-6">
                        <p>{{ $item->product->name }}</p>
                        <p>{{ $item->product->SKU }}</p>
                        <p>{{ $item->requested_qty }}</p>
                        <p>{{ $item->rejected_qty }}</p>
                        <p>Rp {{ number_format($item->total_price) }}</p>
                    </div>
                @endforeach

                <div class="border-b border-gray-200 my-5"></div>

                <div class="grid grid-cols-5 gap-6 items-center text-sm font-medium text-gray-500 mb-4">
                    <div>Upload Bukti Pembayaran</div>
                    <div>Bukti Pembayaran</div>
                    <div>Konfirmasi Penerimaan</div>
                    <div>Status</div>
                    <div>Total Pembayaran</div>
                </div>
                <div class="grid grid-cols-5 gap-6 items-center text-sm">
                    <!-- Upload Bukti Pembayaran -->
                    <div>
                        @if ($data->status == 'user_confirm' && $data->paymentOption->name != 'Paylater')
                            <form action="{{ route('transaction.upload-payment-proof', $data->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="payment_proof" id="payment_proof-{{ $data->id }}"
                                    class="hidden" accept="image/*">
                                <x-button onclick="uploadPaymentProof({{ $data->id }})" type="button" fit
                                    class="bg-primary text-white">Upload Bukti Pembayaran</x-button>
                            </form>
                        @else
                            @if ($data->status == 'user_confirm')
                                <form action="{{ route('transaction.confirm-paylater', $data->id) }}" method="POST">
                                    @csrf
                                    <x-button type="submit" fit class="bg-primary text-white">
                                        Konfirmasi Pembayaran
                                    </x-button>
                                </form>
                            @else
                                <p>-</p>
                            @endif
                        @endif
                    </div>
                    <!-- Bukti Pembayaran -->
                    <div>
                        @if ($data->paymentOption == 'Paylater')
                            <p>-</p>
                        @else
                            @if ($data->payment_proof != null)
                                <a href="{{ asset('storage/payment-proof/' . $data->payment_proof) }}" target="_blank"
                                    class="text-primary underline">Lihat Bukti Pembayaran</a>
                            @endif
                        @endif
                    </div>
                    <!-- Bukti Penerimaan -->
                    <div>
                        @if ($data->status == 'shipping' && $data->receive_proof == null)
                            <form action="{{ route('transaction.confirm-receive', $data->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <x-button type="button" fit class="bg-primary text-white"
                                    onclick="confirmReceive({{ $data->id }})">Konfirmasi Terima
                                    Barang</x-button>
                                <input type="file" name="receipt_proof" id="receipt_proof-{{ $data->id }}"
                                    class="hidden" accept="image/*">
                            </form>
                        @elseif ($data->status == 'done' && $data->receive_proof != null)
                            <a href="{{ asset('storage/receipt-proof/' . $data->receive_proof) }}" target="_blank"
                                class="text-primary underline">Lihat Bukti Penerimaan</a>
                        @endif
                    </div>
                    <!-- Status -->
                    <div>
                        @include('admin.transaction.status', ['status' => $data->status])
                    </div>
                    <!-- Total Pembayaran -->
                    <div>
                        Rp {{ number_format($data->total_price, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="flex flex-col items-center justify-center h-96">
            <p class="text-lg font-semibold text-gray-600">Tidak ada riwayat transaksi</p>
        </div>
    @endforelse

    @push('js-internal')
        <script>
            function uploadPaymentProof(id) {
                document.getElementById(`payment_proof-${id}`).click();

                document.getElementById(`payment_proof-${id}`).addEventListener('change', function() {
                    this.form.submit();
                });
            }

            function confirmReceive(id) {
                document.getElementById(`receipt_proof-${id}`).click();

                document.getElementById(`receipt_proof-${id}`).addEventListener('change', function() {
                    this.form.submit();
                });
            }
        </script>
    @endpush
</x-guest-layout>
