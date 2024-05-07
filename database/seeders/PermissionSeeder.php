<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        $permissions = [
            'create_user',
            'read_user',
            'update_user',
            'delete_user',
            'create_role',
            'read_role',
            'update_role',
            'delete_role',
            'create_permission',
            'read_permission',
            'update_permission',
            'delete_permission',
            'create_category',
            'read_category',
            'update_category',
            'delete_category',
            'create_payment_option',
            'read_payment_option',
            'update_payment_option',
            'delete_payment_option',
            'create_store',
            'read_store',
            'update_store',
            'delete_store',
        ];
        DB::table('permissions')->insert(array_map(fn ($permission) => ['name' => $permission, 'guard_name' => 'web'], $permissions));
    }
}
