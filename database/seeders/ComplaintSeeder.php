<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\Country;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Country $country */
        Complaint::factory()->count(10)->create();
    }
}
