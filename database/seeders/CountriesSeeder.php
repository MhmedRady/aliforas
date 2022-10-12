<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::query()->create([
            'ar' => ['name' => 'مصر'],
            'en' => ['name' => 'Egypt'],
            'country_code' => 'eg'
        ]);
    }
}
