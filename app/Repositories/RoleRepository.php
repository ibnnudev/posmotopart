<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
    private $role;

    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function get()
    {
        return $this->role->all();
    }

    public function getById($id)
    {
        return $this->role->find($id);
    }

    public function getByName($name)
    {
        return $this->role->where('name', $name)->first();
    }

    public function getWhich($place)
    {
        return $this->role->where('is_for', 'like', '%' . $place . '%')->get();
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $role = $this->role->create(['name' => $data['name']]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        try {
            foreach ($data['permissions'] as $permisison) {
                $role->givePermissionTo($permisison);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        DB::commit();
    }

    public function update($id, $data)
    {
        DB::beginTransaction();
        try {
            $role = $this->role->find($id);
            $role->update(['name' => $data['name']]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        try {
            $role->syncPermissions($data['permissions']);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        DB::commit();
    }

    public function delete($id)
    {
        try {
            return $this->role->find($id)->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
