<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        User::query()->create([
            'name' => 'admin',
            'email' => 'admin@localhost',
            'password' => bcrypt('123456789'),
            'is_admin' => 1,
            'is_active' => 1,
        ]);

        User::query()->create([
            'name' => 'seller',
            'email' => 'seller@localhost',
            'password' => bcrypt('123456789'),
            'is_seller' => 1,
            'is_active' => 1,
        ]);

        User::query()->create([
            'name' => 'user',
            'email' => 'user@localhost.local',
            'password' => bcrypt('123456789'),
            'is_active' => 1,
        ]);
    }
}
