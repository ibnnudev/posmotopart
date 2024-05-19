<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Laporan Penjualan', 'url' => ''],
        ['name' => 'Proses Oleh Merchant', 'url' => route('admin.transaction.process-by-merchant')],
    ]" />

    <x-card-container>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Customer</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.transaction.process-by-merchant') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'customer',
                            name: 'customer'
                        },
                        {
                            data: 'payment_option',
                            name: 'payment_option'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
