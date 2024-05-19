<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Top Up', 'url' => route('admin.wallet.index')],
    ]" />
    <x-card-container>
        <table id="walletTableAdmin">
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
            $(function() {
                $('#walletTableAdmin').DataTable({
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
</x-app-layout>
