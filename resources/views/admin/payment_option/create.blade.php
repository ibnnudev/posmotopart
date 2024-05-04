<x-app-layout>
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.payment-option.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <x-input id="name" name="name" label="Name" type="text" required />
                <x-input id="description" name="description" label="Description" type="area" required />
                <x-input id="status" name="status" label="Status" type="number" required />
                <x-input id="admin_fee" name="admin_fee" label="Admin Fee" type="number" required />
                <x-input id="duration" name="duration" label="Duration / day" type="number" required />
                <div>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
