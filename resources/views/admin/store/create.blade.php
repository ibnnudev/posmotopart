<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Daftar Toko', 'url' => route('admin.store.index')],
        ['name' => 'Tambah Toko', 'url' => ''],
    ]" />
    <x-card-container>
        <form action="{{ route('admin.store.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <h1 class="font-medium pb-3 border-b">Informasi Toko</h1>
                    <x-input id="store_name" label="Nama Toko" name="store_name" required />
                    <x-input id="phone" label="No. Telefon" name="phone" required />
                    <x-textarea id="address" label="Alamat" name="address" required />
                    <x-input-file id="logo" label="Logo" name="logo" accept="image/*" />
                </div>
                <div class="space-y-6">
                    <h1 class="font-medium pb-3 border-b">Informasi Owner</h1>
                    <x-input id="name" label="Nama" name="name" required />
                    <x-input id="email" label="Email" name="email" type="email" required />
                </div>
            </div>
            <div class="text-center mt-6">
                <x-button fit type="submit">Simpan</x-button>
                <x-link-button title="Kembali" href="{{ route('admin.store.index') }}" />
            </div>
        </form>
    </x-card-container>
</x-app-layout>
