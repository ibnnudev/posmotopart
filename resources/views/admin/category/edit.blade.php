<x-app-layout>
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.category.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')
                <x-input-file id="logo" name="logo" label="Logo" value="{{ $data->logo }}" />
                <x-input id="name" name="name" label="Nama" type="text" value="{{ $data->name }}"
                    required />
                <div>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
