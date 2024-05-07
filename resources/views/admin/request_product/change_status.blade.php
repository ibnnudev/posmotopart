<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Pengajuan Produk', 'url' => route('admin.request-product.index')],
        ['name' => 'Ubah Status (' . $data->file . ')', 'url' => ''],
    ]" />

    <div class="lg:w-1/2">
        <x-card-container>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700q">Toko</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $data->store->name }}</p>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700q">Pemilik</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $data->user->name }}</p>
                </div>
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700">File</label>
                    <a href="{{ asset('storage/request_product/' . $data->file) }}" target="_blank"
                        class="mt-1 text-sm text-primary hover:underline">{{ $data->file }}</a>
                    <small class="block text-sm text-gray-500">Tgl. Upload:
                        {{ date('d/m/Y H:i', strtotime($data->created_at)) }}
                    </small>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <p class="mt-1 text-sm text-gray-900 uppercase">{{ $data->status }}</p>
                </div>
                <div>
                    <label for="note" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $data->note }}</p>
                </div>
                <div>
                    <label for="note" class="block text-sm font-medium text-gray-700">Di review oleh:</label>
                    <p class="mt-1 text-sm text-gray-900">
                        {{ $data->reviewed_by ? $data->reviewedBy->name : '-' }}
                </div>
            </div>
            <form action="{{ route('admin.request-product.change-status', $data->id) }}" method="post"
                class="{{ $data->status == 'menunggu' ? '' : 'hidden' }}">
                @csrf
                <div class="space-y-6">
                    <x-select id="status" name="status" label="Ubah Status" required>
                        <option value="" selected disabled>Pilih Status</option>
                        <option value="diterima" {{ $data->status == 'diterima' ? 'selected' : '' }}>Diterima
                        </option>
                        <option value="ditolak" {{ $data->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </x-select>
                    <x-textarea id="feedback" name="feedback" label="Catatan" :value="$data->feedback" />
                </div>
                <x-footer-form isLeft="true" backLink="{{ route('admin.request-product.index') }}" />
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script></script>
    @endpush
</x-app-layout>
