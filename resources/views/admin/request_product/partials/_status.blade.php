@if ($data->status == 'menunggu')
    <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded uppercase">menunggu</span>
@elseif ($data->status == 'diterima')
    <span class="bg-green-100 text-primary text-xs font-medium me-2 px-2.5 py-0.5 rounded uppercase">diterima</span>
@elseif ($data->status == 'ditolak')
    <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded uppercase">ditolak</span>
@endif
