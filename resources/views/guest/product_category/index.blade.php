<x-guest-layout>
    <div class="space-y-6">
        @foreach ($categories as $category)
            <div class="flex gap-4 items-center">
                <div class="w-5 h-5 bg-yellow-400 rounded-full"></div>
                <span class="text-sm text-gray-900 uppercase">{{ $category->name }}</span>
            </div>
        @endforeach
    </div>
</x-guest-layout>
