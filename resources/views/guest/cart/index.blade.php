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
                                            <button
                                                onclick="decrementQty('{{ $item->id }}', '{{ $item->product->price }}', '{{ $item->product->discount }}')"
                                                class="increment flex justify-center items-center p-4 h-8 w-8 rounded-lg text-lg bg-gray-100 font-medium text-center">-</button>
                                            <span class="item-quantity px-4 text-base">{{ $item->qty }}</span>
                                            <button
                                                onclick="addQty('{{ $item->id }}', '{{ $item->product->price }}', '{{ $item->product->discount }}')"
                                                class="decrement flex justify-center items-center p-4 h-8 w-8 rounded-lg text-lg bg-gray-100 font-medium text-center">+</button>
                                        </div>
                                        <div class="text-end md:order-4 md:w-32">
                                            @if ($item->product->discount != 0)
                                                <p class="text-md font-medium text-gray-900"
                                                    id="discountPrice-{{ $item->id }}">
                                                    Rp{{ number_format(($item->product->price * $item->product->discount) / 100, 0, ',', '.') }}
                                                </p>
                                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400"
                                                    id="price-{{ $item->id }}">
                                                    <span
                                                        class="line-through value">Rp{{ number_format($item->product->price, 0, ',', '.') }}</span>
                                                    <span
                                                        class="text-primary">({{ number_format($item->product->discount, 0, ',', '.') }}%)</span>
                                                </p>
                                            @else
                                                <p class="text-md font-medium text-gray-900"
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
                                    <p class="text-md font-semibold text-gray-900">Your cart is empty
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
                            <p class="text-sm font-semibold text-gray-900">Detail Pembelian</p>

                            <div class="space-y-4">
                                <dl
                                    class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-sm text-gray-900">Total Harga</dt>
                                    <dd class="text-md font-bold text-gray-900" id="totalSumPrice">
                                        Rp{{ number_format($carts->sum('total_price'), 0, ',', '.') }}
                                    </dd>
                                </dl>
                            </div>
                            <x-link-button href="{{ route('checkout.index') }}" title="Proses Checkout" primary
                                class="w-full text-center" />
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

            let totalPrice = 0;

            function addQty(id, price, discount) {
                let qty = parseInt($(`#counter-${id} .item-quantity`).text());
                qty += 1;
                $(`#counter-${id} .item-quantity`).text(qty);
                if (discount != 0 && discount != null) {
                    totalPrice += (price - (price * discount / 100)) * qty;
                    $(`#discountPrice-${id}`).text(`Rp${((price - (price * discount / 100)) * qty).toLocaleString()}`);
                } else {
                    totalPrice += price * qty;
                    $(`#totalPrice`).text(`Rp${totalPrice.toLocaleString()}`);
                }

                if (discount != 0 && discount != null) {
                    $(`#price-${id} .value`).text(`Rp${(price * qty).toLocaleString()}`);
                } else {
                    $('#price-' + id).text('Rp' + (price * qty).toLocaleString());
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('cart.addQty') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        qty: qty,
                        price: price,
                        total_price: totalPrice
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#totalSumPrice').text('Rp' + response.currentTotalPrice.toLocaleString());
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

            function decrementQty(id, price, discount) {
                let qty = parseInt($(`#counter-${id} .item-quantity`).text());
                if (qty > 1) {
                    qty -= 1;
                    $(`#counter-${id} .item-quantity`).text(qty);
                    if (discount != 0 && discount != null) {
                        totalPrice -= (price - (price * discount / 100)) * qty;
                        $(`#discountPrice-${id}`).text(`Rp${((price - (price * discount / 100)) * qty).toLocaleString()}`);
                    } else {
                        totalPrice -= price * qty;
                        $(`#totalPrice`).text(`Rp${totalPrice.toLocaleString()}`);
                    }

                    if (discount != 0 && discount != null) {
                        $(`#price-${id} .value`).text(`Rp${(price * qty).toLocaleString()}`);
                    } else {
                        $('#price-' + id).text('Rp' + (price * qty).toLocaleString());
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('cart.reduceQty') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                            qty: qty,
                            price: price,
                            total_price: totalPrice
                        },
                        success: function(response) {
                            if (response.status) {
                                $('#totalSumPrice').text('Rp' + response.currentTotalPrice.toLocaleString());
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
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Jumlah tidak boleh kurang dari 1',
                        showConfirmButton: false,
                    });
                }
            }
        </script>
    @endpush
</x-guest-layout>
