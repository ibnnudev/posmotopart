<x-guest-layout>
    <x-breadcrumb :links="[
        ['name' => 'Berdasarkan Kategori', 'url' => route('product-category.index')],
        ['name' => 'Keranjang', 'url' => ''],
    ]" />

    <section class=" antialiased dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

            <div class="md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6">
                        @forelse ($carts as $item)
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <label for="counter-input-{{ $item->id }}" class="sr-only">Choose
                                        quantity:</label>
                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center" id="counter-{{ $item->id }}">
                                            <button type="button" id="decrement-button"
                                                data-input-counter-decrement="counter-input-{{ $item->id }}"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                            <input type="text" id="counter-input-{{ $item->id }}"
                                                data-input-counter
                                                class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                                placeholder="" value="{{ $item->qty }}" readonly />
                                            <button type="button" id="increment-button"
                                                data-input-counter-increment="counter-input-{{ $item->id }}"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="text-end md:order-4 md:w-32">
                                            @if ($item->product->discount != 0)
                                                <p class="text-lg font-medium text-gray-900 dark:text-white"
                                                    id="discountPrice-{{ $item->id }}">
                                                    Rp{{ number_format(($item->product->price * $item->product->discount) / 100, 0, ',', '.') }}
                                                </p>
                                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400"
                                                    id="price-{{ $item->id }}">
                                                    <span
                                                        class="line-through">Rp{{ number_format($item->product->price, 0, ',', '.') }}</span>
                                                    <span
                                                        class="text-primary">({{ number_format($item->product->discount, 0, ',', '.') }}%)</span>
                                                </p>
                                            @else
                                                <p class="text-lg font-medium text-gray-900 dark:text-white"
                                                    id="price-{{ $item->id }}">
                                                    Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <div class="text-sm font-medium text-gray-900 space-y-1">
                                            <div class="md:flex gap-2">
                                                <span class="text-gray-400">SKU :</span>
                                                <span class="font-medium">{{ $item->product->SKU }}</span>
                                            </div>
                                            <div class="md:flex gap-2">
                                                <span class="text-gray-400">Merk :</span>
                                                <span
                                                    class="font-medium">{{ $item->product->productMerk->name }}</span>
                                            </div>
                                            <div class="md:flex gap-2">
                                                <span class="text-gray-400">Produk :</span>
                                                <span class="font-medium">{{ $item->product->name }}</span>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-4">
                                            <button type="button" onclick="removeCart('{{ $item->id }}')"
                                                class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18 17.94 6M18 18 6.06 6" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="rounded-lg border border-gray-200 bg-white py-2 px-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <p class="text-md font-semibold text-gray-900 dark:text-white">Your cart is empty
                                    </p>

                                    <a href="{{ route('product-category.index') }}"
                                        class="flex items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Continue
                                        Shopping</a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                @if ($carts->count() != 0)
                    <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                        <div
                            class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Detail Pembelian</p>

                            <div class="space-y-4">
                                {{-- <div class="space-y-2">
                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-sm font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                                        <dd class="text-sm font-medium text-gray-900 dark:text-white">$799</dd>
                                    </dl>
                                </div> --}}

                                <dl
                                    class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-sm font-bold text-gray-900 dark:text-white">Total Harga</dt>
                                    <dd class="text-sm font-bold text-gray-900 dark:text-white" id="totalPrice">
                                        Rp{{ number_format($carts->sum('total_price'), 0, ',', '.') }}
                                    </dd>
                                </dl>
                            </div>

                            <a href="#"
                                class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed
                                to Checkout</a>

                            <div class="flex items-center justify-center gap-2">
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                                <a href="#" title=""
                                    class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                    Continue Shopping
                                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @push('js-internal')
        <script>
            function removeCart(id) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('cart.delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 500
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 500);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 500
                            });
                        }
                    }
                });
            }
        </script>
    @endpush
</x-guest-layout>
