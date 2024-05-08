<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Update Stok Produk', 'url' => route('admin.product-stock-history.index')],
        ['name' => 'Tambah Entry', 'url' => route('admin.product-stock-history.create')],
    ]" />

    <x-card-container>
        <form action="{{ route('admin.product-stock-history.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-3 gap-6 items-end">
                <x-select id="product_id" name="product_id" label="SKU" required>
                    <option value="">Pilih SKU</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->SKU }}</option>
                    @endforeach
                </x-select>
                <x-input type="number" name="in_stock" label="Qty Masuk" required />
                <x-input type="number" name="out_stock" label="Qty Keluar" required />
            </div>
            <x-footer-form backLink="{{ route('admin.product-stock-history.index') }}" :isLeft="false" />
        </form>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#product_id').select2();
            });
        </script>
    @endpush
</x-app-layout>
