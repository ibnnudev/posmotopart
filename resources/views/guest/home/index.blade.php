<x-guest-layout>
    {{-- <div class="space-y-6">
        @forelse ($categories as $category)
            <div class="flex gap-4 items-center">
                <div class="w-10 h-10 items-center justify-center flex bg-white border border-gray-200 rounded-full">
                    @if ($category->image)
                        <img class="h-5 w-5 object-cover rounded-full"
                            src="{{ asset('storage/product-category/' . $category->image) }}"
                            alt="{{ $category->name }}" />
                    @endif
                </div>
                <span class="text-sm text-gray-900 uppercase">{{ $category->name }}</span>
            </div>

            <div class="grid md:grid-cols-4 lg:grid-cols-8 gap-6">
                @forelse ($category->stores as $store)
                    <div
                        class="bg-white rounded-md px-6 py-2 h-28 flex justify-between flex-col border border-gray-200 hover:bg-orange-50 hover:shadow-lg">
                        <img src="{{ asset('storage/store/' . $store->logo) }}"
                            class="w-auto h-7 object-contain rounded-sm mt-3" alt="{{ $store->name }}">
                        <p class="text-center text-sm line-clamp-3 mb-2 font-medium">{{ $store->name }}</p>
                    </div>
                @empty
                    <div
                        class="bg-white rounded-md px-6 py-2 h-28 flex justify-between flex-col border border-gray-200">
                        <p class="text-center text-sm line-clamp-3 mb-2 font-medium">No store found</p>
                    </div>
                @endforelse
            </div>
        @empty
            <div class="bg-white rounded-md px-6 py-2 h-28 flex justify-between flex-col border border-gray-200">
                <p class="text-center text-sm line-clamp-3 mb-2 font-medium">No category found</p>
            </div>
        @endforelse
    </div> --}}
</x-guest-layout>
