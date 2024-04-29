<x-app-layout>
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <x-input-file id="logo" name="logo" label="Logo" />
                <x-input id="name" name="name" label="Nama" type="text" required />
                <div>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
