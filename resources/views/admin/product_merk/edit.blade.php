<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Variasi Produk', 'url' => route('admin.product-merk.index')],
        ['name' => 'Ubah', 'url' => ''],
    ]" />
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.product-merk.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('put')
                <x-input-file id="image" name="image" label="Foto" :value="$data->image" :path="asset('storage/product-merk/' . $data->image)" preview />
                <x-input id="name" name="name" label="Nama" type="text" required :value="$data->name" />
                <x-select id="product_category_id" name="product_category_id" label="Kategori Produk" required>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}"
                            {{ $item->id == $data->product_category_id ? 'selected' : '' }}>
                            {{ $item->name }}
                    @endforeach
                </x-select>
                <x-select id="is_active" name="is_active" label="Status" required>
                    <option value="1" {{ $data->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $data->is_active == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </x-select>
                <div>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
