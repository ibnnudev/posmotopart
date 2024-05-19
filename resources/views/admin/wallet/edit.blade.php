<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Top Up', 'url' => route('admin.wallet.index')],
        ['name' => 'Ubah', 'url' => ''],
    ]" />
    <div class="md:grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.wallet.update', $wallet->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')
                <x-input id="balance" name="balance" label="Balance" type="number" value="{{ $wallet->balance }}"
                    required />
                <x-select id="status" name="status" label="Status" required>
                    <option value="0" {{ $wallet->status == 0 ? 'selected' : '' }}>Waiting</option>
                    <option value="1" {{ $wallet->status == 1 ? 'selected' : '' }}>Approved</option>
                    <option value="2" {{ $wallet->status == 2 ? 'selected' : '' }}>Rejected</option>
                </x-select>
                <x-button type="submit">Simpan</x-button>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
