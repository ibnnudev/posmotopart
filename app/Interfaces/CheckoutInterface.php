<?php

namespace App\Interfaces;

interface CheckoutInterface
{
    public function getAll();
    public function getByUserId($userId);
}
