<?php

namespace App\Interfaces;

interface ProductMerkInterface
{
    public function getAll();
    public function getById(string $id);
    public function store($data);
    public function update($id, $data);
    public function destroy(string $id);
    public function getByStore($storeid);
    public function getByStoreAndCategory($storeid, $categoryId);
}
