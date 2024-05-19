<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Campaign', 'url' => route('admin.discount.index')],
        ['name' => 'Ubah', 'url' => ''],
    ]" />
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.discount.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')
                <x-input id="logo" name="logo" label="Logo" type="file" value="{{ $data->logo }}" />
                <x-input id="name" name="name" label="name" type="text" value="{{ $data->name }}"
                    required />
                <x-input id="code" name="code" label="code" type="text" value="{{ $data->code }}"
                    required />
                <x-input id="discount" name="discount" label="Discount (%)" value="{{ $data->discount }}"
                    type="number" min="0" max="100" required />
                <x-input id="start_date" name="start_date" label="Start Date" type="date" :value="date('Y-m-d', strtotime($data->start_date))" />
                <x-input id="end_date" name="end_date" label="End Date" type="date" :value="date('Y-m-d', strtotime($data->end_date))" />
                <x-select id="is_active" name="is_active" label="Status" required>
                    <option value="1" {{ $data->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $data->is_active == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </x-select>
                {{-- <x-select id="type" name="type" label="Type">
                    <option value="1">Multi</option>
                    <option value="2">Single</option>
                </x-select> --}}
                <x-button type="submit">Simpan</x-button>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            $(function() {
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
