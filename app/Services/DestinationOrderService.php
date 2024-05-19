<?php

namespace App\Services;

use App\Models\DestinationOrder;

class DestinationOrderService
{
    private $destinationOrder;

    public function __construct(DestinationOrder $destinationOrder)
    {
        $this->destinationOrder = $destinationOrder;
    }

    public function getByUserId()
    {
        return $this->destinationOrder->where('user_id', auth()->user()->id)->active()->get();
    }

    public function store($data)
    {
        $data['user_id'] = auth()->user()->id;
        return $this->destinationOrder->create($data);
    }
}
