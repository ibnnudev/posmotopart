<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Metode Pembayaran', 'url' => route('admin.payment-option.index')],
    ]" />
    <x-card-container>
        <div class="text-end my-4">
            <a href="{{ route('admin.payment-option.create') }}"
                class="px-4 py-2 bg-primary text-white rounded-md">Tambah</a>
        </div>
        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>Nama</td>
                    <td>Deskripsi</td>
                    <td>Status</td>
                    <td>Admin Fee (%)</td>
                    <td>Durasi / hari</td>
                    <td>Aksi</td>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function btnDelete(id) {
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ route('admin.payment-option.destroy', ':id') }}`.replace(':id', id),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Berhasil!',
                                    'Data berhasil dihapus.',
                                    'success'
                                );
                                $('table').DataTable().ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    'Data gagal dihapus.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }

            $(function() {
                $('table').DataTable({
                    processing: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('admin.payment-option.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'description',
                            name: 'description',
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data) {
                                if (data == 1) {
                                    return '<span class="text-green-500">Aktif</span>';
                                } else {
                                    return '<span class="text-red-500">Non Aktif</span>';
                                }
                            }
                        },
                        {
                            data: 'admin_fee',
                            name: 'admin_fee',
                        },
                        {
                            data: 'duration',
                            name: 'duration',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
