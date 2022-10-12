<?php

namespace Database\Seeders;

use App\Models\AttributeCategory;
use App\Models\Translations\AttributeCategoryTranslation;
use Database\Factories\AttributeCategoryFactory;
use Illuminate\Database\Seeder;

    class AttributeCategorySeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */

        public function run()
        {
            AttributeCategory::query()->create([
//            'attribute_id' => 1,
            'category_id' => 1,
            'is_active' => true,
            'created_at' => now()
        ]);
            $attrTrans = [
            ['locale'=>'ar',
             'attribute_category_id' => 1,
             'name' => 'الالوان'
            ],
            ['locale'=>'en',
             'attribute_category_id' => 1,
             'name' => 'ِColors'
            ]
        ];
            foreach ($attrTrans as $item) {
                $Trans =  new AttributeCategoryTranslation();
                $Trans -> locale    = $item['locale'] ;
                $Trans -> name      = $item['name'] ;
                $Trans->attribute_category_id = $item['attribute_category_id'];
                $Trans->save();
            }
        }
    }
