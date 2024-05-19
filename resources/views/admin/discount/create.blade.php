<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Campaign', 'url' => route('admin.discount.index')],
        ['name' => 'Tambah', 'url' => ''],
    ]" />
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.discount.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <x-input-file id="logo" name="logo" label="Logo" required />
                <x-input id="name" name="name" label="Nama" type="text" required />
                <x-input id="code" name="code" label="Code" type="text" required />
                <x-input id="discount" name="discount" label="Discount" type="number" required min="0"
                    max="100" />
                <x-input id="start_date" name="start_date" label="Start Date" type="date" required />
                <x-input id="end_date" name="end_date" label="End Date" type="date" required />
                <x-select id="is_active" name="is_active" label="Status" required>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </x-select>
                {{-- <x-select id="type" name="type" label="Type">
                    <option value="1">Multi</option>
                    <option value="2">Single</option>
                </x-select> --}}
                <div>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                // if end date is less than start date, show aler
                $('input#end_date').on('change', function() {
                    const startDate = new Date($('input#start_date').val());
                    const endDate = new Date($('input#end_date').val());
                    if (endDate < startDate) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Tanggal berakhir tidak boleh kurang dari tanggal mulai!',
                        });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
