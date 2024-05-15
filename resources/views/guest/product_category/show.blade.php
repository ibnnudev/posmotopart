<x-guest-layout>
    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Merk</th>
                <th>Mesin</th>
                <th>SAE</th>
                <th>Tipe</th>
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Diskon</th>
                <th>Harga Final</th>
                <th>Stok</th>
                <th>Jumlah Barang</th>
            </tr>
        </thead>
    </table>

    @push('js-internal')
        <script>
            $(function() {
                $('table').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('product-category.show', ['categoryId' => $categoryId, 'storeId' => $storeId]) }}',
                    columns: [{
                            data: 'sku',
                            name: 'sku'
                        },
                        {
                            data: 'merk',
                            name: 'merk'
                        },
                        {
                            data: 'machine_name',
                            name: 'machine_name'
                        },
                        {
                            data: 'SAE',
                            name: 'SAE'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'size',
                            name: 'size'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'discount',
                            name: 'discount'
                        },
                        {
                            data: 'final_price',
                            name: 'final_price'
                        },
                        {
                            data: 'stock',
                            name: 'stock'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                    ]
                });
            });
        </script>
    @endpush
</x-guest-layout>
