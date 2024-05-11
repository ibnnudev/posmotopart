<?php

namespace App\Interfaces;

interface StoreInterface
{
    public function getAll();
    public function getById($id);
    public function store($data);
    public function update($id, $data);
    public function destroy($id);

    public function updateStatus($id, $status);
    public function updateStoreOnly($id, $data);
    public function updateBank($id, $data);
}
