<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        $roles = [
            User::ADMIN,
            User::SELLER,
            User::BUYER,
        ];
        Role::insert(array_map(fn ($role) => ['name' => $role, 'guard_name' => 'web'], $roles));
    }
}
