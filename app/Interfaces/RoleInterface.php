<?php

namespace App\Interfaces;

interface RoleInterface
{
    public function get();
    public function getById($id);
    public function getByName($name);
    public function getWhich($place);
    public function store($data);
    public function update($id, $data);
    public function delete($id);
}
