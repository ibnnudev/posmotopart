<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Kategori Produk', 'url' => route('admin.product-category.index')],
        ['name' => 'Ubah Kategori Produk', 'url' => '#'],
    ]" />
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.product-category.update', $data->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('put')
                <x-input-file id="image" name="image" label="Gambar" :value="$data->image" preview :path="asset('storage/product-category/' . $data->image)" />
                <x-input id="name" name="name" label="Nama" type="text" required :value="$data->name" />
                <div>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
