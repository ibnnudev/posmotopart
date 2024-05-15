@if ($data->image)
    <img src="{{ asset('storage/product-merk/' . $data->image) }}" class="w-20 h-20 rounded-sm" alt="">
@else
    <span>-</span>
@endif
