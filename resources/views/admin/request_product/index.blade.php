<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Pengajuan Produk', 'url' => ''],
    ]" />

    <x-card-container>
        <div class="text-end mb-4 flex justify-end gap-2">
            <x-link-button href="{{ asset('files/pengajuan_produk.csv') }}" title="Download Template" />
            <form action="{{ route('admin.request-product.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" id="file" class="hidden" accept=".csv" />
                <x-button id="importButton" type="button" fit="true" onclick="uploadFile()">
                    Upload Pengajuan (.csv)
                </x-button>
            </form>
        </div>

        <table id="requestProduct">
            <thead>
                <tr>
                    <th>#</th>
                    <th>File</th>
                    <th>Tgl. Upload</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Reviewer</th>
                    @role('admin')
                        <th>Aksi</th>
                    @endrole
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
                $('#requestProduct').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.request-product.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'file',
                            name: 'file'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'feedback',
                            name: 'feedback'
                        },
                        {
                            data: 'reviewer',
                            name: 'reviewer'
                        },
                        @role('admin')
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            }
                        @endrole
                    ]
                });
            });

            @include('components.flash-message')
        </script>
    @endpush
</x-app-layout>
