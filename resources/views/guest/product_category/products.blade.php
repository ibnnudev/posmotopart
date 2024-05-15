<x-guest-layout>
    <x-breadcrumb :links="[
        ['name' => 'Berdasarkan Kategori', 'url' => route('product-category.index')],
        ['name' => 'Grosir', 'url' => route('product-category.index')],
        [
            'name' => $store->name,
            'url' => route('product-category.show', [
                'categoryId' => $productMerk->product_category_id,
                'storeId' => $store->id,
            ]),
        ],
        ['name' => $productMerk->name, 'url' => ''],
    ]" />


    <div class="justify-center w-full">
        <div class="justify-start w-full text-left">
            <div x-data="{ tab: 'tab' }" x-init="tab = 'tab-{{ $products->keys()->first() }}'">
                <ul class="flex gap-3 text-gray-500">
                    @foreach ($products as $key => $val)
                        <li class="-mb-px">
                            <a @click.prevent="tab = 'tab-{{ $key }}'" href="#_"
                                class="inline-block px-4 py-1 text-md font-medium uppercase rounded-lg text-white bg-primary"
                                :class="{ '  text-white bg-primary': tab === 'tab-{{ $key }}' }">
                                {{ $key }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="py-4 pt-4 text-left content">
                    @foreach ($products as $key => $val)
                        <div x-show="tab === 'tab-{{ $key }}'"
                            class="{{ $loop->first ? 'block' : 'hidden' }} ">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                @forelse ($val as $data)
                                    <x-card-container class="text-sm">
                                        <div class="lg:flex justify-between items-center">
                                            <span class="text-gray-500">SKU</span>
                                            <span class="font-medium">{{ $data->SKU }}</span>
                                        </div>
                                        <div class="lg:flex justify-between items-center">
                                            <span class="text-gray-500">Ukuran</span>
                                            <span class="font-medium">{{ $data->size ?? '-' }}</span>
                                        </div>
                                        <div class="lg:flex justify-between items-center">
                                            <span class="text-gray-500">Harga</span>
                                            <div class="font-medium">
                                                @if ($data->discount != 0.0)
                                                    <span class="line-through text-gray-500">Rp
                                                        {{ number_format($data->price, 0, ',', '.') }}</span>
                                                    <span class="text-red-500">Rp
                                                        {{ number_format($data->price - ($data->price * $data->discount) / 100, 0, ',', '.') }}</span>
                                                @else
                                                    <span class="text-primary">Rp
                                                        {{ number_format($data->price, 0, ',', '.') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="lg:flex justify-between items-center">
                                            <span class="text-gray-500">Stok</span>
                                            <span class="font-medium">{{ $data->stock }}</span>
                                        </div>
                                        {{-- <div
                                            class="mt-3 pt-4 border-t border-t-gray-200 lg:flex items-center justify-between">
                                            <span class="text-gray-500">Jumlah Barang</span>
                                            <div class="flex items-center gap-2">
                                                <button wire:click="decrement('{{ $data->id }}')"
                                                    class="bg-gray-200 text-gray-600 px-2 py-1 rounded-md focus:outline-none">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <span>1</span>
                                                <button wire:click="increment('{{ $data->id }}')"
                                                    class="bg-primary text-white px-2 py-1 rounded-md focus:outline-none">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div> --}}
                                        @if ($data->stock != 0 || $data->stock != null)
                                            @if ($data->cart)
                                                <div class="lg:flex justify-end items-center mt-6">
                                                    {{-- <span class="text-gray-500">Keranjang</span> --}}
                                                    <x-link-button title="Lihat Keranjang" class="text-center"
                                                        icon="fas fa-info-circle" href="{{ route('cart.index') }}" />
                                                </div>
                                            @else
                                                <div class="lg:flex justify-end items-center mt-6">
                                                    {{-- <span class="text-gray-500">Keranjang</span> --}}
                                                    <x-link-button title="Keranjang" primary class="text-center"
                                                        onclick="addToCart('{{ $data->id }}')"
                                                        icon="fas fa-shopping-cart" />
                                                </div>
                                            @endif
                                        @else
                                            <div class="lg:flex justify-end items-center mt-6">
                                                <span class="text-red-500">Stok Habis</span>
                                            </div>
                                        @endif
                                    </x-card-container>
                                @empty
                                    <x-card-container>
                                        <div class="text-center">
                                            <h1 class="text-2xl font-bold text-gray-700">Data Tidak Ditemukan</h1>
                                        </div>
                                    </x-card-container>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('js-internal')
        <script>
            function addToCart(id) {
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: id,
                        qty: 1,
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // reload
                            setTimeout(() => {
                                location.reload();
                            }, 500);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            }
        </script>
    @endpush

</x-guest-layout>
