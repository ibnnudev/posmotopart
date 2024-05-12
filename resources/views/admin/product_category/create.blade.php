<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Kategori Produk', 'url' => route('admin.product-category.index')],
        ['name' => 'Tambah', 'url' => route('admin.product-category.create')],
    ]" />
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.product-category.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <x-input-file id="image" name="image" label="Gambar" required />
                <x-input id="name" name="name" label="Nama" type="text" required />
                <div>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
