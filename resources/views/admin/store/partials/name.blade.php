<div class="flex items-center px-3 text-gray-900 whitespace-nowrap dark:text-white">
    @if ($data->logo)
        <img class="w-10 h-10 rounded-full object-contain" src="{{ asset('storage/store/' . $data->logo) }}"
            alt="{{ $data->name }}">
    @else
        <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('assets/images/noimage.png') }}"
            alt="{{ $data->name }}">
    @endif

    <div class="ps-3">
        <div class="text-sm font-semibold">
            {{ $data->name }}
        </div>
        <div class="font-normal text-xs text-gray-500">{{ $data->user->name ?? '-' }}</div>
    </div>
</div>
