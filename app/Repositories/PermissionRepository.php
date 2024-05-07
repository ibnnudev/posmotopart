<?php

namespace App\Repositories;

use App\Interfaces\PermissionInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionInterface
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function get()
    {
        return $this->permission->all()->sortByDesc('id');
    }

    public function getById($id)
    {
        return $this->permission->find($id);
    }

    public function store($data)
    {
        return $this->permission->create($data);
    }

    public function update($id, $data)
    {
        $this->permission->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->permission->find($id)->delete();
    }
}
