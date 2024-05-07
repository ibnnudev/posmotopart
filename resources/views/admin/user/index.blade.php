<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Manajemen Pengguna', 'url' => '#'],
    ]" title="Manajemen Pengguna" />

    <x-card-container>
        <div class="text-end mb-4">
            <div class="text-end my-5">
                <a href="{{ route('admin.user.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-md">Tambah</a>
            </div>
        </div>
        <table id="userTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Hak Akses</th>
                    <th>Tgl. Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function btnDelete(_id, _name) {
                let url = '{{ route('admin.user.destroy', ':id') }}'.replace(':id', _id);
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: `Pengguna ${_name} akan dihapus!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Berhasil!',
                                    'Pengguna berhasil dihapus.',
                                    'success'
                                ).then(() => {
                                    $('#userTable').DataTable().ajax.reload(null, false);
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    'Pengguna gagal dihapus.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }

            $(function() {
                $('#userTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.user.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'join_date',
                            name: 'join_date'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });

            @include('components.flash-message')
        </script>
    @endpush

</x-app-layout>
