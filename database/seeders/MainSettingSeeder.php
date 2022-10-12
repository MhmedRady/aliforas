<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\MainSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class MainSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mainSetting = [
            ['key' => 'taxes', 'value' => 0, 'created_at' => now()],

            ['key' => 'address', 'created_at' => now()],
            ['key' => 'lat', 'created_at' => now()],
            ['key' => 'lng', 'created_at' => now()],
            ['key' => 'email', 'created_at' => now()],
            ['key' => 'phone', 'created_at' => now()],
            ['key' => 'whatsapp', 'created_at' => now()],

            ['key' => 'facebook', 'created_at' => now()],
            ['key' => 'twitter', 'created_at' => now()],
            ['key' => 'instagram', 'created_at' => now()],

        ];
        foreach ($mainSetting as $main):
            MainSetting::query()->create($main);
        endforeach;
    }
}
