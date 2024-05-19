<x-guest-layout>
    <x-breadcrumb :links="[
        ['name' => 'Berdasarkan Kategori', 'url' => route('product-category.index')],
        ['name' => 'Checkout', 'url' => route('checkout.index')],
    ]" />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-card-container>
            <h1 class="text-sm font-medium mb-8">
                Ringkasan pesanan
            </h1>
            @foreach ($carts as $item)
                <div
                    class="flex justify-between items-center mb-4 pb-4 {{ !$loop->last ? 'border-b border-b-gray-300' : '' }}">
                    <div class="flex items-center">
                        <div class="ml-4">
                            <h1 class="text-sm font-medium">{{ $item->product->name }}</h1>
                            <h1 class="text-sm text-gray-500">{{ $item->qty }} x Rp
                                {{ number_format($item->product->price, 0, ',', '.') }}</h1>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="flex justify-between items-center mt-4 mx-4 border-t border-t-gray-300 pt-6">
                <div>
                    <h1 class="text-sm font-medium">Total</h1>
                </div>
                <div>
                    <h1 class="text-sm font-medium">Rp {{ number_format($carts->sum('total_price'), 0, ',', '.') }}
                    </h1>
                </div>
            </div>
        </x-card-container>
        <x-card-container>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <h1 class="text-sm font-medium mb-8">
                    Alamat Pengiriman
                </h1>
                @if ($destinationOrders->count() != 0)
                    <div class="space-y-6">
                        @foreach ($destinationOrders as $item)
                            {{-- radio --}}
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="radio" id="address-{{ $item->id }}" name="address_id"
                                        value="{{ $item->id }}" required {{ $loop->first ? 'checked' : '' }}
                                        class="focus:ring-0 text-primary border-gray-300 dark:border-gray-600">
                                    <label for="address-{{ $item->id }}"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $item->address }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                            class="w-full block text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary rounded-lg text-sm px-5 py-2.5 text-center"
                            type="button">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Alamat Baru
                        </button>
                    </div>
                @else
                    <p class="text-xs text-gray-500 mb-1">
                        Kamu belum memiliki alamat pengiriman <span class="text-red-500">*</span>
                    </p>
                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                        class="w-full block text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary rounded-lg text-sm px-5 py-2.5 text-center"
                        type="button">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Alamat
                    </button>
                @endif
        </x-card-container>
        <x-card-container>
            <h1 class="text-sm font-medium mb-8">
                Metode Pembayaran
            </h1>
            <div class="space-y-6">
                <div class="space-y-2">
                    <x-select id="payment_option_id" name="payment_option_id" label="Pilih metode pembayaran" required>
                        @foreach ($paymentOptions as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </x-select>
                    <div id="payment_option_description"
                        class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                        role="alert">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span class="desc">{{ $paymentOptions->first()->description }}</span>
                    </div>
                </div>
            </div>
        </x-card-container>
    </div>
    @if ($destinationOrders->count() != 0)
        <x-footer-form title="Proses Pembayaran" :isLeft="false" />
    @endif
    </form>

    <!-- Main modal -->
    <div id="popup-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                        Tambah Alamat Pengiriman
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4">
                    <form class="space-y-6" action="{{ route('checkout.add-shipping') }}" method="POST">
                        @csrf
                        <x-input id="province" label="Provinsi" name="province" type="text" required />
                        <x-input id="regency" label="Kota/Kabupaten" name="regency" type="text" required />
                        <x-input id="district" label="Kecamatan" name="district" type="text" required />
                        <div class="grid lg:grid-cols-2 gap-6">
                            <x-input id="postal_code" label="Kode Pos" name="postal_code" type="text" />
                            <x-input id="plus_code" label="Kode Plus" name="plus_code" type="text" />
                        </div>
                        <x-textarea id="address" label="Alamat" name="address" required />
                        <div class="grid grid-cols-2 gap-6">
                            <x-input id="latitude" label="Latitude" name="latitude" type="text" required />
                            <x-input id="longitude" label="Longitude" name="longitude" type="text" required />
                        </div>
                        {{-- <x-select id="is_default" name="is_default" label="Jadikan alamat utama">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </x-select> --}}
                        <x-footer-form :backButton="false" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                const paymentOptionDescription = $('#payment_option_description span.desc');
                const paymentOptionId = $('#payment_option_id');
                let paymentOptions = @json($paymentOptions);
                $(paymentOptionId).on('change', function() {
                    const selectedPaymentOption = paymentOptions.find(item => item.id == $(this).val());
                    paymentOptionDescription.html(selectedPaymentOption.description);
                });
            });
        </script>
    @endpush
</x-guest-layout>
