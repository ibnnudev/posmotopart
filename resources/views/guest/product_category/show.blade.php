<x-guest-layout>
    <x-breadcrumb :links="[
        ['name' => 'Berdasarkan Kategori', 'url' => route('product-category.index')],
        ['name' => 'Grosir', 'url' => route('product-category.index')],
        ['name' => $store->name, 'url' => ''],
    ]" />
    <div class="grid md:grid-cols-4 lg:grid-cols-8 gap-6">
        @forelse ($productMerks as $item)
            <a href=""
                class="bg-white rounded-md px-6 py-2 h-32 flex justify-between flex-col border border-gray-200 hover:bg-orange-50 hover:shadow-lg">
                <img src="{{ asset('storage/product-merk/' . $item->image) }}"
                    class="w-auto h-10 object-contain rounded-sm mt-3" alt="{{ $item->name }}">
                <p class="text-center text-sm line-clamp-3 mb-2 font-medium">{{ $item->name }}</p>
            </a>
        @empty
            <x-card-container>
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-gray-700">Data Tidak Ditemukan</h1>
                </div>
            </x-card-container>
        @endforelse
    </div>
</x-guest-layout>
