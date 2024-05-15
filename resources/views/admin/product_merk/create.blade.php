<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Variasi Produk', 'url' => route('admin.product-merk.index')],
        ['name' => 'Tambah', 'url' => route('admin.product-merk.create')],
    ]" />
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.product-merk.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <x-input-file id="image" name="image" label="Foto" required />
                <x-input id="name" name="name" label="Nama" type="text" required />
                <x-select id="product_category_id" name="product_category_id" label="Kategori Produk" required>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </x-select>
                <x-select id="is_active" name="is_active" label="Status" required>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </x-select>
                <div>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
