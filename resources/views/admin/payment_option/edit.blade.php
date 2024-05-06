<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Metode Pembayaran', 'url' => route('admin.payment-option.index')],
        ['name' => 'Ubah', 'url' => ''],
    ]" />
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.payment-option.update', $data->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <x-input id="name" name="name" label="Name" type="text" value="{{ $data->name }}" required />
                <x-input id="description" name="description" label="Description" type="area"
                    value="{{ $data->description }}" required />
                <x-input id="status" name="status" label="Status" type="number" value="{{ $data->status }}"
                    required />
                <x-input id="admin_fee" name="admin_fee" label="Admin Fee (%)" value="{{ $data->admin_fee }}"
                    type="number" required />
                <x-input id="duration" name="duration" label="Duration / day" type="number"
                    value="{{ $data->duration }}" />
                <x-button type="submit">Simpan</x-button>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
