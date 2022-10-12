<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Translations\CategoryTranslation;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories_en = ['Electronics', 'Laptop', 'TVs', 'Headphones & Speakers', 'Cameras & Accessories', 'Kindle'];
        $categories_ar = ['إلكترونيات', 'لابتوب', 'تلفزيونات', 'سماعات', 'الكاميرات و ملحقاتها', 'تابلت للقراءه'];
        foreach ($categories_ar as $x => $cat) {
            $category = new \App\Models\Category();
            $category->parent_id = $x == 0 ? null : 1;
            $category->code = $cat;
            $category->is_active = true;
            $category->in_header = false;
            $category->save();

            $categoryTransAr = new \App\Models\Translations\CategoryTranslation();
            $categoryTransAr->name = $cat;
            $categoryTransAr->category_id = $category->id;
            $categoryTransAr->slug = Str::slug($cat);
            $categoryTransAr->locale = 'ar';
            $categoryTransAr->save();

            $categoryTrans = new \App\Models\Translations\CategoryTranslation();
            $categoryTrans->name = $categories_en[$x];
            $categoryTrans->category_id = $category->id;
            $categoryTrans->slug = Str::slug($categories_en[$x]);
            $categoryTrans->locale = 'en';
            $categoryTrans->save();
        }

        // Category::factory(15)
        // ->create()
        // ->each(function (Category $category) {
        //     foreach (['ar', 'en'] as $lang) {
        //         CategoryTranslation::factory()->create([
        //             'category_id'  =>  $category->id,
        //             'locale'    =>  $lang
        //         ]);
        //     }

        //     Product::factory(5)
        //     ->create()
        //     ->each(function ($product) use ($category) {
        //         $product->categories()->save($category);
        //     });

        //     Attribute::inRandomOrder()->take(5)
        //     ->each(function ($attribute) use ($category) {
        //         $attribute->group_categories()->attach($category);
        //     });
        // });
        $names = ['Clothing', 'Men','Bags', 'Blazers', 'Dresses', 'Jackets', 'jeans', 'Shirts', 'Shoes', 'T-Shirts', 'Uncategorized', 'Women' ];
        $names_ar = ['ملابس', 'رجالي','حقائب', 'بليزر', 'فساتين', 'سترات', 'جينز', 'قمصان', 'أحذية', 'تي شيرتات', 'غير مصنف', 'نسائي' ];
        $slugs = ['Clothing', 'men','bags', 'blazers', 'dresses', 'jackets', 'jeans', 'shirts', 'shoes', 't-shirts', 'uncategorized', 'women' ];
        $images = [
            'https://mstore.io/wp-content/uploads/2017/06/cloth.png',
            'https://mstore.io/wp-content/uploads/2017/06/man.png',
            null,
            null,
            'https://mstore.io/wp-content/uploads/2017/06/poster.png',
            null,
            null,
            null,
            null,
            null,
            null,
            'https://mstore.io/wp-content/uploads/2017/11/woman.png',
        ];

        foreach ($names as $key => $name) {
            $category = new \App\Models\Category();
            $category->parent_id = $key == 0 ? null : 7;
            $category->code = $name;
            $category->is_active = true;
            $category->in_header = false;
            $category->icon = $images[$key];
            $category->save();

            $categoryTransAr = new \App\Models\Translations\CategoryTranslation();
            $categoryTransAr->name = $names_ar[$key];
            $categoryTransAr->category_id = $category->id;
            $categoryTransAr->slug = $slugs[$key];
            $categoryTransAr->locale = 'ar';
            $categoryTransAr->save();

            $categoryTrans = new \App\Models\Translations\CategoryTranslation();
            $categoryTrans->name = $name;
            $categoryTrans->category_id = $category->id;
            $categoryTrans->slug = $slugs[$key];
            $categoryTrans->locale = 'en';
            $categoryTrans->save();
        }
    }
}
