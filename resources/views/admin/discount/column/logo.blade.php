@if ($data->logo != null)
    <img src="{{ asset('storage/discount/' . $data->logo) }}" width="24" height="24" alt="">
@else
    <span>-</span>
@endif
