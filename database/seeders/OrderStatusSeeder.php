<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::query()->insert([
            [
                'name' => 'New',
                'type' => 'new',
            ], [
                'name' => 'Processing',
                'type' => 'processing',
            ], [
                'name' => 'Payment',
                'type' => 'payment',
            ], [
                'name' => 'Review',
                'type' => 'review',
            ], [
                'name' => 'Completed',
                'type' => 'completed',
            ], [
                'name' => 'Cancelled',
                'type' => 'cancelled',
            ], [
                'name' => 'Declined',
                'type' => 'declined',
            ]
        ]);
    }
}
