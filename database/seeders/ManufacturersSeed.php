<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Seeder;

class ManufacturersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Manufacturers = [
            [
                'name' => 'هواوي',
                'name_en' => 'HUAWEI',
                'logo' => 'https://seeklogo.com/images/H/Huawei-logo-A8C7CBCAA8-seeklogo.com.png',
            ],
            [
                'name' => 'Nike',
                'name_en' => 'Nike	',
                'logo' => 'https://brandirectory-live-public.s3.eu-west-2.amazonaws.com/logos/7fafdfee-74f3-40fc-8c56-3b8c0832613d.jpg%3FNike.jpg',
            ],
            [
                'name' => 'H&M',
                'name_en' => 'H&M',
                'logo' => 'https://brandirectory-live-public.s3.eu-west-2.amazonaws.com/logos/f13f5f57-d435-4639-8718-bb9d7c47cf8a.jpg%3FH%2526M.jpg',
            ],
            [
                'name' => 'Zara',
                'name_en' => 'Zara',
                'logo' => 'https://brandirectory-live-public.s3.eu-west-2.amazonaws.com/logos/7b4734bc-74ca-4ac5-9727-5cb230adb3fb.jpg%3FZara.jpg',
            ],
            [
                'name' => 'Adidas',
                'name_en' => 'Adidas',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Adidas_Logo.svg/1000px-Adidas_Logo.svg.png',
            ],
            [
                'name' => 'ترايد لاين',
                'name_en' => 'Trade line',
                'logo' => 'https://tradelinestores.s3-accelerate.amazonaws.com/static/logo-n.png',
            ]
        ];
        foreach ($Manufacturers as $m) {
            $Manufacturer = new \App\Models\Manufacturer();
            $Manufacturer->logo = $m['logo'];
            $Manufacturer->code = $m['name_en'];
            $Manufacturer->save();

            $ManufacturerTransAr = new \App\Models\Translations\ManufacturerTranslation();
            $ManufacturerTransAr->name = $m['name'];
            $ManufacturerTransAr->manufacturer_id = $Manufacturer->id;
            $ManufacturerTransAr->locale = 'ar';
            $ManufacturerTransAr->save();

            $ManufacturerTrans = new \App\Models\Translations\ManufacturerTranslation();
            $ManufacturerTrans->name = $m['name_en'];
            $ManufacturerTrans->manufacturer_id = $Manufacturer->id;
            $ManufacturerTrans->locale = 'en';
            $ManufacturerTrans->save();
        }

//        Manufacturer::factory()->count(70)->create();
    }
}
