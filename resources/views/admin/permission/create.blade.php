<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Manajemen Permission', 'url' => route('admin.permission.index')],
        ['name' => 'Tambah Permission', 'url' => ''],
    ]" title="Tambah Permission" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.permission.store') }}" method="POST">
                @csrf
                <x-input id="name" label="Nama" name="name" required />
                <div class="max-md:w-full md:w-1/2 lg:w-1/4 xl:w-1/4 pt-5">
                    <x-button type="submit">Simpan</x-button>
                </div>
        </x-card-container>
    </div>
</x-app-layout>
