<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InventoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventory = new \App\Models\Inventory();
        $inventory->name = 'New Cairo';
        $inventory->save();

        $inventory = new \App\Models\Inventory();
        $inventory->name = 'Nasr City';
        $inventory->save();
    }
}
