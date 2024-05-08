<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Update Stok Produk', 'url' => null],
    ]" />

    <x-card-container>
        <div class="text-end mb-4 flex justify-end gap-2">
            <x-link-button href="{{ route('admin.product-stock-history.download-template') }}"
                title="Download Template" />
            <form action="{{ route('admin.product-stock-history.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" id="file" class="hidden" accept=".csv" />
                <x-button id="importButton" type="button" fit="true" onclick="uploadFile()">
                    Upload CSV
                </x-button>
            </form>
            <x-link-button href="{{ route('admin.product-stock-history.create') }}" title="Tambah Entry" />
        </div>

        <table id="productHistory">
            <thead>
                <tr>
                    {{-- <th>#</th> --}}
                    <th>Nama Admin</th>
                    <th>SKU</th>
                    <th>Seller SKU</th>
                    <th>Nama Produk</th>
                    <th>Stok Masuk</th>
                    <th>Stok Keluar</th>
                    <th>Final Stok</th>
                    <th>Tanggal</th>
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

                    // check if extension is not csv
                    const file = document.getElementById('file').files[0];
                    const extension = file.name.split('.').pop();
                    if (extension !== 'csv') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Format file tidak didukung. Silahkan upload file dengan format .csv',
                        });

                        document.getElementById('importButton').innerText = 'Upload Pengajuan (.csv)';
                        document.getElementById('importButton').removeAttribute('disabled');
                        document.getElementById('importButton').classList.remove('cursor-not-allowed');

                        return;
                    }

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
                $('#productHistory').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.product-stock-history.index') }}',
                    columns: [
                        // {
                        //     data: 'DT_RowIndex',
                        //     name: 'DT_RowIndex'
                        // },
                        {
                            data: 'created_by',
                            name: 'created_by'
                        },
                        {
                            data: 'sku',
                            name: 'sku'
                        },
                        {
                            data: 'product_name',
                            name: 'product_name'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'in_stock',
                            name: 'in_stock'
                        },
                        {
                            data: 'out_stock',
                            name: 'out_stock'
                        },
                        {
                            data: 'final_stock',
                            name: 'final_stock'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                    ]
                });
            });

            @include('components.flash-message')
        </script>
    @endpush
</x-app-layout>
