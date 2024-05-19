<?php

namespace App\Interfaces;

interface WalletInetrface
{
    public function getAll();
    public function getById($id);
    public function store($data, $userId);
    public function update($id, $data);
    public function destroy($id);
    public function getByUserId($id);
}
