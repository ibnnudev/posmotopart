<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Campaign', 'url' => route('admin.discount.index')],
        ['name' => 'Mengikuti', 'url' => route('admin.discount.show', $discount->id)],
    ]" />
    <x-card-container>
        <div class="flex items-center gap-2">
            <img class="rounded-lg mr-4" src="{{ asset('storage/discount/' . $discount->logo) }}" width="60"
                height="60" alt="">
            <div>
                <h1 class="text-2xl font-bold">{{ $discount->name }}</h1>
                <p class="text-gray-500">Kode : {{ $discount->code }}</p>
                <p class="text-gray-500 mt-2">Berlaku sampai</p>
                <p>{{ date('d/m/Y', strtotime($discount->end_date)) }}</p>
            </div>
        </div>
    </x-card-container>
    <x-card-container>
        <table id="discountDetailTable">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Logo</td>
                    <td>Name</td>
                    <td>Pemilik</td>
                    <td>Alamat</td>
                    <td>No Telp</td>
                    <td>Status</td>
                </tr>
            </thead>
        </table>
    </x-card-container>
    @push('js-internal')
        <script>
            $(function() {
                $('#discountDetailTable').DataTable({
                    processing: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('admin.discount.show', $discount->id) }}',
                    columns: [{
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
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'owner',
                            name: 'owner',
                        },
                        {
                            data: 'address',
                            name: 'address',
                        },
                        {
                            data: 'phone',
                            name: 'phone',
                        },
                        {
                            data: 'status',
                            name: 'status',
                        },
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
