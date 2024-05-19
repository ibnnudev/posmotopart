<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Top Up', 'url' => route('admin.wallet.index')],
        ['name' => 'Tambah', 'url' => ''],
    ]" />
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.wallet.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <x-input id="balance" name="balance" label="Blance" type="number" required />
                <div>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
