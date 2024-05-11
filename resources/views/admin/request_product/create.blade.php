<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Pengajuan Produk', 'url' => route('admin.request-product.index')],
        ['name' => 'Tambah', 'url' => route('admin.request-product.create')],
    ]" />
    <div class="max-w-md">
        <x-card-container>
            <form action="{{ route('admin.request-product.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <div class="space-y-6">
                        <x-select id="product_category_id" name="product_category_id" label="Kategori Produk" required>
                            <option value="" disabled>Pilih Kategori Produk</option>
                            @foreach ($productCategories as $productCategory)
                                <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-file id="file" name="file" label="File (.csv)" required accept=".csv" />
                        <x-footer-form isLeft="true" backLink="{{ route('admin.request-product.index') }}" />
                    </div>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
