@if ($data->image)
    <img class="h-5 w-5 object-cover rounded-sm" src="{{ asset('storage/product-category/' . $data->image) }}"
        alt="{{ $data->name }}" />
@else
    <img class="h-5 w-5 object-cover rounded-sm" src="{{ asset('assets/images/noimage.png') }}"
        alt="{{ $data->name }}" />
@endif
