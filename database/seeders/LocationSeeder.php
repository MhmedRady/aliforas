<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Location::query()->create([
            'location' => 'فرع الكرمة ( اسكنرية )',
            'city_id' => 1,
        ]);
        \App\Models\Location::query()->create([
            'location' => 'فرع دمنهور',
            'city_id' => 2,
        ]);
        \App\Models\Location::query()->create([
            'location' => 'فرع بني سويف',
            'city_id' => 3,
        ],
        );
    }
}
