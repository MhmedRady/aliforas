<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Translations\BrandTranslation;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'name' => 'ترايد لاين',
                'name_en' => 'Trade line',
                'logo' => 'https://concordplaza-eg.com/wp-content/uploads/2018/10/Tradeline.jpg',
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
                'name' => 'هواوي',
                'name_en' => 'HUAWEI',
                'logo' => 'https://seeklogo.com/images/H/Huawei-logo-A8C7CBCAA8-seeklogo.com.png',
            ],
            [
                'name' => 'سامسونج',
                'name_en' => 'Samsung',
                'logo' => 'https://www.androidworld9.com/wp-content/uploads/2014/04/samsung-logo.jpeg',
            ],
            [
                'name' => 'رايفن',
                'name_en' => 'RaVin',
                'logo' => 'https://plobalapps.s3.ap-southeast-1.amazonaws.com/rt-assets/images/1547210440183598296.jpg',
            ],
            [
                'name' => 'انتل',
                'name_en' => 'Intel',
                'logo' => 'https://logodownload.org/wp-content/uploads/2014/04/intel-logo-1-1.png',
            ],
            [
                'name' => 'تانك',
                'name_en' => 'Tank',
                'logo' => 'https://image.shutterstock.com/image-vector/tank-logo-template-military-concept-260nw-705450571.jpg',
            ]
        ];
        foreach ($brands as $b) {
            $brand = new \App\Models\Brand();
            $brand->logo = $b['logo'];
            $brand->save();

            $categoryTransAr = new \App\Models\Translations\BrandTranslation();
            $categoryTransAr->name = $b['name'];
            $categoryTransAr->brand_id = $brand->id;
            $categoryTransAr->locale = 'ar';
            $categoryTransAr->save();

            $categoryTrans = new \App\Models\Translations\BrandTranslation();
            $categoryTrans->name = $b['name_en'];
            $categoryTrans->brand_id = $brand->id;
            $categoryTrans->locale = 'en';
            $categoryTrans->save();
        }

        // Brand::factory(15)
        // ->create()
        // ->each(function ($brand) {
        //     foreach (['ar', 'en'] as $lang) {
        //         BrandTranslation::factory()->create([
        //             'brand_id'  =>  $brand->id,
        //             'locale'    =>  $lang
        //         ]);
        //     }

        //     Product::factory(5)
        //     ->create()
        //     ->each(function ($product) use ($brand) {
        //         $product->brand_id = $brand->id;
        //     });
        // });
    }
}
