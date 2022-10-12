<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use App\Models\ProductImage;
use App\Models\BranchProduct;
use App\Models\ProductCategory;
use App\Models\Translations\CategoryTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $souq = false;
        $num = 50;
        $json = File::get("database/json/get_category_cache.json");
        $data = json_decode($json, true);
        $list = [];
        foreach (collect($data) as $p) {
            foreach (collect($p) as $prod) {
                $list[] = $prod;
            }
        }

        $list2 = collect($list)->map(function ($product) {
            $hot = Arr::random([false, true]);
            $sale = Arr::random([false, true]);
            $start = now()->addDays(rand(0, 15));
            $end = now()->addDays(rand(30, 120));
            $companyBrandId = rand(2, 5);

            return  [
                'name'              =>  $product['name'],
                'name_ar'           =>  $product['name'],
                'slug'              =>  $product['slug'],
                'description'       =>  $product['description'],
                'description_ar'    =>  $product['description'],
                'is_active'         =>  true,
                'is_point'          =>  true,
                'price'             =>  $product['price'],
                'is_hot'            =>  $hot,
                'hot_starts_at'     =>  $hot ? $start : null,
                'hot_ends_at'       =>  $hot ? $end : null,
                'hot_price'         =>  $hot ? ((int)($product['price']) - ((int)($product['price'])/10)) : 0,
                'before_price'      =>  $hot || $sale ? ((int)$product['price']*rand(2,4)) : 0,
                'on_sale'           =>  !$hot ? $sale : false,
                'seller_id'         =>  !$hot  && !$sale ? 2 : null,
                'return_allowed'    =>  false,
                'return_duration'   =>  rand(3, 15),
                'minimum_stock'     =>  rand(10, 50),
                'stock'             =>  rand(10, 100),
                'manufacturer_id'   =>  $companyBrandId,
                'brand_id'          =>  $companyBrandId,
                'category'          =>  rand(8, 15) ,
                'images'            =>  array_column($product['images'], 'src'),
            ];

        });

        /*if ($souq) {
            $num = 500;
            $products = get_products('https://deals.souq.com/eg-ar/%D9%85%D9%88%D8%A8%D8%A7%D9%8A%D9%84%D8%A7%D8%AA-%D9%88%D8%A7%D9%83%D8%B3%D8%B3%D9%88%D8%A7%D8%B1%D8%A7%D8%AA/c/14731');
            $products = array_merge($products, get_products('https://egypt.souq.com/eg-ar/hp/laptops---and---notebooks-75/a-t/s/?fbs=yes&sortby=sr&'));

            echo "FOUND " . sizeof($products) . "s products" . PHP_EOL;

            foreach ($products as $link) {
                $link = $link['link'];
                # if ($x == 1) break;

                echo "FETCHING " . $link . PHP_EOL;

                $en = get_product($link, 'en');
                $pro = get_product($link);

                $product = new \App\Models\Product();
                $product->name = mb_substr($pro['title'], 0, 190);
                $product->slug = trim(mb_substr(str_replace(' ', "-", $pro['title']), 0, 190));
                $product->description = $pro['description'];
                $product->brand_id = rand(1, 5);
                $product->manufacturer_id = rand(1, 5);
                $product->stock = rand(1, 30);
                $product->minimum_stock = rand(1, 7);
                // $product->price             = $p['price'];
                $product->before_price = rand(10000, 999999);
                $product->hot_price = rand(10000, 999999);
                $product->price = rand(1, 10000);
                $product->is_active = true;
                $product->up_selling = rand(0, 1);
                $on_sale = rand(0, 1);
                $is_hot = rand(0, 1);
                $product->on_sale = $on_sale;
                $product->is_hot = $is_hot;
                if ($is_hot) {
                    $product->hot_starts_at = now()->addDays(rand(1, 99));
                    $product->hot_ends_at = now()->addDays(rand(1, 99));
                }
                $product->return_allowed = rand(0, 1);
                $product->return_duration = rand(1, 7);
                $product->thumbnail = $pro['thumbnail'];
                $product->save();

                $pt = new \App\Models\ProductTranslation();
                $pt->product_id = $product->id;
                $pt->name = mb_substr($en['title'], 0, 190);
                $pt->slug = trim(str_replace(' ', "-", mb_substr($pt->name, 0, 190)));
                $pt->locale = 'en';
                $pt->description = $en['description'];
                $pt->save();

                foreach ($pro['images'] as $img) {
                    $productImg = new ProductImage();
                    $productImg->image = $img;
                    $productImg->product_id = $product->id;
                    $productImg->save();
                }
            }
        } else*/
        // {
        //     Product::factory()->count(500)->create()->each(function ($product) {
        //         $faker = \Faker\Factory::create();
        //         $productTrans = new \App\Models\Translations\ProductTranslation();
        //         $productTrans->name = $faker->name;
        //         $productTrans->slug = $faker->slug;
        //         $productTrans->description = $faker->text;
        //         $productTrans->locale = 'en';
        //         $productTrans->product_id = $product->id;
        //         $productTrans->save();

        //         $branches = new BranchProduct();
        //         $branches->product_id = $product->id;
        //         $branches->branch_id = rand(1, 2);
        //         $branches->quantity = rand(1, 10);
        //         $branches->save();

        //         $image = new ProductImage();
        //         $image->product_id = $product->id;
        //         $image->image = $faker->imageUrl;
        //         $image->created_at = now();
        //         $image->save();
        //         # $product->images()->save(factory(App\ProductImage::class, 2)->make());
        //     });
        // }
        foreach ($list2 as $product) {
            $p = new Product();
            $p->is_active       = count($product['images']) && $product['stock']? $product['is_active']:false;
            $p->is_point        = $product['is_point'];
            $p->price           = (int) $product['price'];
            $p->is_hot          = $product['is_hot'];
            $p->hot_starts_at   = $product['hot_starts_at'];
            $p->hot_ends_at     = $product['hot_ends_at'];
            $p->hot_price       = (int)$product['hot_price'];
            $p->before_price    = (int)$product['before_price'];
            $p->on_sale         = $product['on_sale'];
            $p->seller_id       = $product['seller_id'];
            $p->return_allowed  = $product['return_allowed'];
            $p->return_duration = $product['return_duration'];
            $p->minimum_stock   = $product['minimum_stock'];
            $p->stock           = $product['stock'];
            $p->manufacturer_id = $product['manufacturer_id'];
            $p->brand_id        = $product['brand_id'];
            $p->save();

            $productTrans = new \App\Models\Translations\ProductTranslation();
            $productTrans->name = $product['name'];
            $productTrans->slug = $product['slug'];
            $productTrans->description = $product['description'];
            $productTrans->locale = 'en';
            $productTrans->product_id = $p->id;
            $productTrans->save();

            $productTrans = new \App\Models\Translations\ProductTranslation();
            $productTrans->name = $product['name'];
            $productTrans->slug = $product['slug'];
            $productTrans->description = $product['description'];
            $productTrans->locale = 'ar';
            $productTrans->product_id = $p->id;
            $productTrans->save();

            if (!is_null($product['seller_id'])){
                $branches = new BranchProduct();
                $branches->product_id = $p->id;
                $branches->branch_id = rand(1, 2);
                $branches->quantity = rand(1, 10);
                $branches->save();
            }

            foreach ($product['images'] as $img) {
                $image = new ProductImage();
                $image->product_id = $p->id;
                $image->image = $img;
                $image->created_at = now();
                $image->save();
            }

            $category = Category::query()->find($product['category']);

            if ($category->parent_id){
                ProductCategory::query()->insert([
                    'category_id' => $category->parent_id,
                    'product_id' => $p->id,
                ]);
            }
            ProductCategory::query()->insert([
                'category_id' => $product['category'],
                'product_id' => $p->id,
            ]);
        }
    }
}
