<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();

        $superAdmin = User::create([
            'name' => 'Admin',
            'email' => 'admin@moto.com',
            'password' => password_hash('password', PASSWORD_DEFAULT)
        ]);
        $superAdmin->assignRole(User::ADMIN);

        $seller = User::create([
            'name' => 'Seller',
            'email' => 'seller@moto.com',
            'password' => password_hash('password', PASSWORD_DEFAULT)
        ]);
        $seller->assignRole(User::SELLER);

        $buyer = User::create([
            'name' => 'Buyer',
            'email' => 'buyer@moto.com',
            'password' => password_hash('password', PASSWORD_DEFAULT)
        ]);
        $buyer->assignRole(User::BUYER);
    }
}
