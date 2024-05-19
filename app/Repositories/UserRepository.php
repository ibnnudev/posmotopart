<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class UserRepository implements UserInterface
{
    private $user;
    private $permission;

    public function __construct(User $user, Permission $permission)
    {
        $this->user = $user;
        $this->permission = $permission;
    }

    public function getAll()
    {
        return $this->user->get();
    }

    public function getById($id)
    {
        return $this->user->find($id);
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $password = bcrypt('password');
            $user = $this->user->create(array_merge($data, ['password' => $password]));
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        }

        try {
            $user->assignRole($data['role']);
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        DB::commit();
    }

    public function update($id, $data)
    {
        DB::beginTransaction();

        try {
            $user = $this->user->find($id);

            if ($user->email != null && $user->phone != null && $user->card_number != null && $user->bank_name != null && $user->owner_name != null && $user->province != null && $user->regency != null && $user->district != null && $user->zip_code != null && $user->address != null && $user->nik != null) {
                $data['profile_filled'] = true;
            } else {
                $data['profile_filled'] = false;
            }


            $user->update($data);
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        try {
            $user->syncRoles($data['role']);
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        DB::commit();
    }

    public function destroy($id)
    {
        try {
            return $this->user->find($id)->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updatePermission($id, $data)
    {
        try {
            $user = $this->user->find($id);
            $user->syncPermissions($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
