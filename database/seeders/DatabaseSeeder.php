<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            LanguageSeeder::class,
            OrderStatusSeeder::class,
            CouponsSeeder::class,
            UsersSeeder::class,
            MainSettingSeeder::class,
            CategoriesSeeder::class,
            BrandsSeeder::class,
            ManufacturersSeed::class,
//            AttributeCategorySeeder::class,
            //PagesSeeder::class,
            //ModulesSeeder::class,
            //PackagesSeeder::class,
            CountriesSeeder::class,
            StatesSeeder::class,
            CitiesSeeder::class,
            LocationSeeder::class,
            RolesSeeder::class,
            ProductsSeeder::class,
            ComplaintSeeder::class,
            BranchSeeder::class
            //AttributesSeeder::class,
            //InventoriesSeeder::class,
        ]);
    }
}
