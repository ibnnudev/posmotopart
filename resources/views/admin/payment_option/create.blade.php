<x-app-layout>
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.payment-option.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <x-input id="name" name="name" label="Nama" type="text" required />
                <x-input id="description" name="description" label="Deskripsi" type="area" required />
                <x-select id="status" name="status" label="Status" required>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </x-select>
                <x-input id="admin_fee" name="admin_fee" label="Admin Fee" type="number" required />
                <x-input id="duration" name="duration" label="Durasi / hari" type="number" required />
                <div>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
