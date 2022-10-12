<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::query()->insert([
            [
                'name' => 'happy eid',
                'code' => 'happyeid100',
                'type' => 'P',
                'amount' => '25',
                'start' => '2019-01-10',
                'end' => '2019-01-11',
                'usage_times' => '100',
                'user_usage_times' => '5',
                'min_order' => '1000'
            ],
            [
                'name' => 'happy moms day',
                'code' => 'happymom',
                'type' => 'P',
                'amount' => '30',
                'start' => '2019-01-11',
                'end' => '2019-01-12',
                'usage_times' => '1000',
                'user_usage_times' => '100',
                'min_order' => '10000'
            ],
            [
                'name' => 'new year',
                'code' => 'newyear',
                'type' => 'F',
                'amount' => '100',
                'start' => '2020-01-01',
                'end' => '2020-01-02',
                'usage_times' => '56',
                'user_usage_times' => '2',
                'min_order' => '5000'
            ]
        ]);
    }
}
