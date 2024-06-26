<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Campaign', 'url' => route('admin.discount.index')],
    ]" />
    <x-card-container>
        @role('admin')
            <div class="text-end my-4">
                <a href="{{ route('admin.discount.create') }}" class="px-4 py-2 bg-primary text-white rounded-md">Tambah</a>
            </div>
        @endrole
        <table id="discountTable">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Logo</td>
                    <td>Name</td>
                    <td>Code</td>
                    <td>Discount</td>
                    <td>Start Date</td>
                    <td>End Date</td>
                    @if (auth()->user()->hasRole('seller'))
                        <td>Kondisi</td>
                    @endif
                    <td>Action</td>
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
                            url: `{{ route('admin.discount.destroy', ':id') }}`.replace(':id', id),
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
                var columns = [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'logo',
                        name: 'logo',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'code',
                        name: 'code',
                    },
                    {
                        data: 'discount',
                        name: 'discount',
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                    },
                    {
                        data: 'end_date',
                        name: 'end_date',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ];

                @if (Auth::user()->hasRole('seller'))
                    columns.splice(7, 0, {
                        data: 'condition',
                        name: 'condition',
                    });
                @endif

                $('#discountTable').DataTable({
                    processing: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('admin.discount.index') }}',
                    columns: columns
                });
            });
        </script>
    @endpush
</x-app-layout>
