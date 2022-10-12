<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\Product;
use App\Models\Translations\AttributeTranslation;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            [
                'group_id' => null,
            ],
            [
                'group_id' => null,
            ],
            [
                'group_id' => '1',
            ],
            [
                'group_id' => '1',
            ],
            [
                'group_id' => '2',
            ],
            [
                'group_id' => '2'
            ],
            [
                'group_id' => '2'
            ],
            [
                'group_id' => null,
            ],
            [
                'group_id' => '8',
            ],
            [
                'group_id' => '8',
            ]
        ];
        $attribute_translations = [
            [
                'locale' => 'en',
                'name' => 'processor',
                'attribute_id' => '1'
            ],
            [
                'locale' => 'en',
                'name' => 'color',
                'attribute_id' => '2'
            ],
            [
                'locale' => 'en',
                'name' => 'octa cores',
                'attribute_id' => '3'
            ],
            [
                'locale' => 'en',
                'name' => '4 cores',
                'attribute_id' => '4'
            ],
            [
                'locale' => 'en',
                'name' => 'red',
                'attribute_id' => '5'
            ],
            [
                'locale' => 'en',
                'name' => 'green',
                'attribute_id' => '6'
            ],
            [
                'locale' => 'en',
                'name' => 'blue',
                'attribute_id' => '7'
            ],
            [
                'locale' => 'en',
                'name' => 'shape',
                'attribute_id' => '8'
            ],
            [
                'locale' => 'en',
                'name' => 'sharp',
                'attribute_id' => '9'
            ],
            [
                'locale' => 'en',
                'name' => 'rounded',
                'attribute_id' => '10'
            ],
            [
                'locale' => 'ar',
                'name' => 'معالج',
                'attribute_id' => '1'
            ],
            [
                'locale' => 'ar',
                'name' => 'اللون',
                'attribute_id' => '2'
            ],
            [
                'locale' => 'ar',
                'name' => 'ثماني النواة',
                'attribute_id' => '3'
            ],
            [
                'locale' => 'ar',
                'name' => 'رباعي النواة',
                'attribute_id' => '4'
            ],
            [
                'locale' => 'ar',
                'name' => 'احمر',
                'attribute_id' => '5'
            ],
            [
                'locale' => 'ar',
                'name' => 'اخضر',
                'attribute_id' => '6'
            ],
            [
                'locale' => 'ar',
                'name' => 'ازرق',
                'attribute_id' => '7'
            ],
            [
                'locale' => 'ar',
                'name' => 'الشكل',
                'attribute_id' => '8'
            ],
            [
                'locale' => 'ar',
                'name' => 'حاد',
                'attribute_id' => '9'
            ],
            [
                'locale' => 'ar',
                'name' => 'دائري',
                'attribute_id' => '10'
            ]
        ];

        Attribute::query()->insert($attributes);
        AttributeTranslation::query()->insert($attribute_translations);
        $attributesIds = Attribute::query()->pluck('id');
        $productsIds = Product::query()->pluck('id');
        for ($i = 1; $i <= 500; $i++) {
            AttributeProduct::query()->insert([
                'attribute_id' => $attributesIds->random(),
                'product_id' => $productsIds->random(),
                'quantity' => rand(100, 1000)
            ]);
        }

        // $productsIds = Product::inRandomOrder()->take(5)->get()->pluck('id')->toarray();
        // Attribute::factory(10)
        // ->create()
        // ->each(function ($attribute) use ($productsIds) {
        //     foreach (['ar', 'en'] as $lang) {
        //         AttributeTranslation::factory()->create([
        //             'attribute_id'  =>  $attribute->id,
        //             'locale'        =>  $lang
        //         ]);
        //     }

        //     $attribute->attrWithProducts()->attach($productsIds);
        // });
    }
}
