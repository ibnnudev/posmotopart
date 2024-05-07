<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Produk', 'url' => route('admin.product.index')],
    ]" />

    <x-card-container>
        <div class="text-end mb-4 flex justify-end gap-2">
            <x-link-button href="{{ asset('files/template_import_product.csv') }}" title="Download Template" />
            <form action="{{ route('admin.product.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" id="file" class="hidden" accept=".csv" />
                <x-button id="importButton" type="button" fit="true" onclick="uploadFile()">Import
                    Produk</x-button>
            </form>
        </div>

        <table id="productTable">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>SKU Seller</th>
                    <th>Nama Produk</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function uploadFile() {
                document.getElementById('file').click();

                document.getElementById('file').onchange = function() {
                    document.getElementById('importButton').innerText = 'Mengunggah...';
                    document.getElementById('importButton').setAttribute('disabled', 'disabled');
                    document.getElementById('importButton').classList.add('cursor-not-allowed');

                    // add overlay sweet alert loading
                    Swal.fire({
                        title: 'Sedang mengunggah...',
                        html: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                    });

                    document.getElementById('importButton').parentElement.submit();
                };
            }

            $(function() {
                $('#productTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.product.index') }}',
                    columns: [{
                            data: 'sku',
                            name: 'sku'
                        },
                        {
                            data: 'sku_seller',
                            name: 'sku_seller'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'stock',
                            name: 'stock'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        // {
                        //     data: 'action',
                        //     name: 'action',
                        //     orderable: false,
                        //     searchable: false
                        // },
                    ],
                    // show 50 rows by default
                    lengthMenu: [
                        [10, 25, 50, 100, 500],
                        [10, 25, 50, 100, 500]
                    ],
                    pageLength: 50,
                    // set the initial value
                    order: [
                        [0, 'asc']
                    ],
                    // set the default order column
                    orderCellsTop: true,
                });
            });

            @include('components.flash-message')
        </script>
    @endpush
</x-app-layout>
