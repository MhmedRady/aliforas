<?php

namespace Database\Seeders;

use App\Models\BranchProduct;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OldProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = collect(json_decode(file_get_contents(database_path('json/brands.json')), true)['RECORDS']);
        $brands->each(function ($item) {
            /** @var Brand $brand */
            $brand = Brand::query()->find($item['id']);
            if (is_null($brand))
                $brand = Brand::query()->create([
                    'id' => $item['id'],
                    'logo' => $item['logo'],
                ]);
            else
                $brand->update([
                    'logo' => $item['logo'],
                ]);

            $brand->fill([
                'ar' => [
                    'name' => $item['name_ar'],
                    'meta_title' => $item['meta_title_ar'],
                    'meta_keywords' => $item['meta_keywords_ar'],
                    'meta_description' => $item['meta_description_ar'],
                ],
                'en' => [
                    'name' => $item['name_en'],
                    'meta_title' => $item['meta_title_en'],
                    'meta_keywords' => $item['meta_keywords_en'],
                    'meta_description' => $item['meta_description_en'],
                ],
            ]);
            $brand->save();
        });

        $data = collect(json_decode(file_get_contents(database_path('json/products.json')), true)['RECORDS']);
        $data->each(function ($item) {
            /** @var Product $product */
            $product = Product::query()->find($item['id']);
            if (is_null($product))
                $product = Product::query()->create([
                    'id' => $item['id'],
                    'brand_id' => $item['brand_id'],
                    'manufacturer_id' => $item['manufacturer_id'] ?: null,
                    'stock' => $item['stock'],
                    'minimum_stock' => $item['minimum_stock'],
                    'price' => 0,
                ]);
            else
                $product->update([
                    'brand_id' => $item['brand_id'],
                    'manufacturer_id' => $item['manufacturer_id'] ?: null,
                    'stock' => $item['stock'],
                    'minimum_stock' => $item['minimum_stock'],
                    'price' => 0,
                ]);

            $product->fill([
                'ar' => [
                    'name' => $item['name_ar'],
                    'description' => $item['description_ar'],
                    'slug' => $item['slug_ar'],
                ],
                'en' => [
                    'name' => $item['name_en'],
                    'description' => $item['description_en'],
                    'slug' => $item['slug_en'],
                ]
            ]);
            $product->save();
        });
    }
}
