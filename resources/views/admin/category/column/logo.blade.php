@if (!$logo)
    -
@else
    <img src="{{ asset('storage/categories/' . $logo) }}" class="w-12 h-12 object-cover rounded-md"
        alt="{{ $logo }}">
@endif
