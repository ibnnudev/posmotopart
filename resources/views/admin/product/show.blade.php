<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Produk', 'url' => route('admin.product.index')],
        ['name' => $data->SKU, 'url' => route('admin.product.show', $data->id)],
    ]" />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-card-container>
            <h1 class="font-medium mb-4">Detail SKU</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-500">SKU</p>
                    <p>{{ $data->SKU }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Nama Produk</p>
                    <p>{{ $data->name }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Seller SKU</p>
                    <p>{{ $data->SKU_seller ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Unit</p>
                    <p>{{ $data->unit ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Manufaktur</p>
                    <p>{{ $data->manufacturer ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Ukuran</p>
                    <p>{{ $data->size ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">SAE</p>
                    <p>{{ $data->SAE ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Mesin</p>
                    <p>{{ $data->machine_name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Merk</p>
                    <p>{{ $data->merk ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Tipe</p>
                    <p>{{ $data->type ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Stok</p>
                    <p>{{ $data->stock ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Harga Unit</p>
                    <p>Rp {{ number_format($data->price, 0, ',', '.') }}</p>
                </div>
            </div>
        </x-card-container>
        <x-card-container>
            <h1 class="font-medium mb-4">Riwayat SKU</h1>
        </x-card-container>
    </div>
</x-app-layout>