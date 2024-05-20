<x-guest-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Top Up', 'url' => route('admin.wallet.index')],
    ]" />
    <x-card-container>
        <h1 class="text-base">Total Saldo</h1>
        <p class="text-lg font-bold">{{ $totalBalance }}</p>
    </x-card-container>
    <x-card-container>
        <div class="text-end my-4">
            <a href="{{ route('admin.wallet.create') }}" class="px-4 py-2 bg-primary text-white rounded-md">Top Up</a>
        </div>
        <table id="walletTable">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Status</td>
                    <td>Tanggal Pengajuan</td>
                    <td>Total</td>
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
                            url: `{{ route('admin.wallet.destroy', ':id') }}`.replace(':id', id),
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
                $('#walletTable').DataTable({
                    processing: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('admin.wallet.index') }}',
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
                            data: 'status',
                            name: 'status',
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                        },
                        {
                            data: 'balance',
                            name: 'balance',
                        },
                        {
                            data: 'action',
                            name: 'action',
                        },
                    ]
                });
            });
        </script>
    @endpush
</x-guest-layout>
