<?php

namespace App\Interfaces;

interface RequestProductInterface
{
    public function getAll();
    public function getByStore($store_id);
    public function getById($id);
    public function addEntry($data);
    public function changeStatus($id, $data);
    public function import($data);
}
