<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Daftar Toko', 'url' => route('admin.store.index')],
        ['name' => 'Ubah Toko', 'url' => ''],
    ]" />
    <x-card-container>
        <form action="{{ route('admin.store.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <h1 class="font-medium pb-3 border-b">Informasi Toko</h1>
                    <x-input id="store_name" label="Nama Toko" name="store_name" required :value="$data->name" />
                    <x-input id="phone" label="No. Telefon" name="phone" required :value="$data->phone" />
                    <x-textarea id="address" label="Alamat" name="address" required :value="$data->address" />
                    <x-input-file id="logo" label="Logo" name="logo" accept="image/*" :value="$data->logo" />
                </div>
                <div class="space-y-6">
                    <h1 class="font-medium pb-3 border-b">Informasi Owner</h1>
                    <x-input id="name" label="Nama" name="name" required :value="$data->user->name" />
                    <x-input id="email" label="Email" name="email" type="email" required :value="$data->user->email" />
                </div>
            </div>
            <div class="text-center mt-6">
                <x-button fit type="submit">Simpan</x-button>
                <x-link-button title="Kembali" href="{{ route('admin.store.index') }}" />
            </div>
        </form>
    </x-card-container>
</x-app-layout>
