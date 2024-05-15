<?php

namespace App\Interfaces;

interface CartInterface
{
    public function getByUserId($userId);
    public function add($data);
    public function update($data);
    public function delete($data);
    public function checkout($data);
}
