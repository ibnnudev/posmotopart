@if ($data->image)
    <img src="{{ asset('storage/product-merk/' . $data->image) }}" class="w-24 h-24 rounded-sm" alt="">
@else
    <span>-</span>
@endif
