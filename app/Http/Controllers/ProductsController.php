<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilteredProductResource;
use App\Models\Attribute;
use App\Models\BranchProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ProductsController extends Controller
{
    public function __construct()
    {
        $locale = App::getLocale();
        View::share('locale', $locale);
    }

    public function index(\Illuminate\Http\Request $request)
    {
        return view('root.products.index');
    }

    public function api(Request $request)
    {
        $name = $request->input('searchName');

        $name = $request->input('searchName');
        $category = $request->input('categoryId');

        $categories = $request->post('categories');

        if (!is_null($request->categoryId) && $category !=0 ){
            if (!in_array($request->categoryId, $request->post('categories'))){
                array_push($categories, (int)$request->categoryId);
                $request->merge(['categories' => $categories]);
//                $request->merge(['categoryId'=>null]);
            }
        }

//        return $request->post('categories');

        $filterBrandQuery = function ($query) use ($request, $name) {
            $this->checkCategoryQueryRelation($request, $query);
            if ($request->has('companies') && is_array($request->post('companies')) && count($request->post('companies')) > 0) {
                $query->whereHas('images')->whereIn('manufacturer_id', $request->post('companies'));
            }
        };

        $filterCompanyQuery = function ($query) use ($request, $name) {
            $this->checkCategoryQueryRelation($request, $query);
            if ($request->has('brands') && is_array($request->post('brands')) && count($request->post('brands')) > 0) {
                $query->whereHas('images')->whereIn('brand_id', $request->post('brands'));
            }
//            if (!is_null($name))
//            {
//                $query->whereHas('translations', function ($q) use ($name) {
//                    return $q->where('name', 'like', "%$name%");
//                });
//            }
        };

//        if (!is_null($name)){
//            $query->whereHas('translations', function ($q) use ($name) {
//                return $q->where('name', 'like', "%$name%");
//            });
//        }

        $filterAttributeQuery = function ($query) use ($request) {
            $this->checkCategoryQueryRelation($request, $query);
//            if ($request->has('attributes') && is_array($request->post('attributes')) && count($request->post('attributes')) > 0)
//                $query->whereIn('attributes.id', $request->post('attributes'));
        };

        $filterOptionsCategories = Category::query()->whereNull('parent_id')
            ->where(function (Builder $query) use ($name){
                $query->whereHas('products', function ($query) use ($name){
                    if (!is_null($name)){
                        $query->whereHas('translations', function ($q) use ($name) {
                            return $q->where('name', 'like', "%$name%");
                        });
                    }
                })->orWhereHas('children', fn ($q) => $q->whereHas('products', function ($query) use ($name){
                    if (!is_null($name)){
                        $query->whereHas('translations', function ($q) use ($name) {
                            return $q->where('name', 'like', "%$name%");
                        });
                    }
                })
                    ->orWhereHas('children'));
            })->with([
                'children' => fn ($q) => $q->whereHas('products', function ($query) use($name){
                    if (!is_null($name)){
                        $query->whereHas('translations', function ($q) use ($name) {
                            return $q->where('name', 'like', "%$name%");
                        });
                    }
                })->orWhereHas('children')->withCount('products')
            ])->withCount('products');

        $filterOptionsBrands = Brand::query()->whereHas('products', $filterBrandQuery)->withCount([
            'products as products_count' => $filterBrandQuery
        ]);
        $filterOptionsCompanies = Manufacturer::query()->whereHas('products', $filterCompanyQuery)->withCount([
            'products as products_count' => $filterCompanyQuery
        ]);

        $filterOptionsAttributes = Attribute::query()->whereNull('group_id')->where('is_active', true)
            ->whereHas('attrWithProducts', $filterAttributeQuery)->whereHas('childes')
            ->with('childes', fn ($q) => $q->where('is_active', true)->whereHas('attrWithProducts')->withCount('attrWithProducts as products_count'))
            ->withCount(['attrWithProducts as products_count'=>$filterAttributeQuery])
            ->orderByDesc('products_count');

        $filterOptionsCategories = $filterOptionsCategories->limit(100)->get();
        $filterOptionsBrands = $filterOptionsBrands->limit(100)->get();
        $filterOptionsCompanies = $filterOptionsCompanies->limit(100)->get();
        $filterOptionsAttributes = $filterOptionsAttributes->limit(5)->get();

        $productQuery = Product::query()->whereIsActive(true)->has('images')->where(function ($query) use ($request, $category, $name) {

            if ($request->has('brands') && is_array($request->post('brands')) && count($request->post('brands')) > 0) {
                $query->whereIn('brand_id', $request->post('brands'));
            }
////
            if ($request->has('categories') && is_array($request->post('categories')) && count($request->post('categories')) > 0) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('categories.id', array_values($request->post('categories')))
                        ->orWhereIn('categories.parent_id', array_values($request->post('categories')));
                });
            }
////
            if ($request->has('categories') && !is_array($request->post('categories'))) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('categories.id', array_values($request->post('categories')))
                        ->orWhereIn('categories.parent_id', array_values($request->post('categories')));
                });
            }

            if (!is_null($name)){
                if ($request->get('categoryId') && $request->get('categoryId') > 0)
                {
                    $query->where('is_active', true)
                        ->whereHas('categories', function ($q) use ($category) {
                            return $q->where('category_id', $category);
                        });
//                    $query->whereHas('translations', function ($q) use ($name) {
//                        return $q->where('name', 'like', "%$name%");
//                    });
                }
                $query->whereHas('translations', function ($q) use ($name) {
                    return $q->where('name', 'like', "%$name%");
                });
            }

//            if ($request->get('categoryId')){
//                $query->where('is_active', true)
//                    ->whereHas('categories', function ($q) use ($category) {
//                        return $q->where('category_id', $category);
//                    });
//            }

            if ($request->has('companies') && is_array($request->post('companies')) && count($request->post('companies')) > 0) {
                $query->whereIn('manufacturer_id', $request->post('companies'));
            }

            if ($request->has('attributes') && is_array($request->post('attributes')) && count($request->post('attributes')) > 0) {
                $query->whereHas('attributes', function ($q) use ($request) {
                    return $q->whereIn('attributes.id', $request->post('attributes'));
                });
            }
        })->with(['images' /*=> function ($q) {
            $q->limit(2);
        }*/, 'brand']);

        if ($request->post('price_2')){
//            return 'price_2';
            $prices = [];
            $prices[] = $request->post('price_1', 0);
            $prices[] = $request->post('price_2', 1000000);
            $productQuery->whereBetween('price', $prices);
        }
//        else{
//            $productQuery->where('price', '>', $request->post('price_1', 0));
//        }

//        return $request->post('price_1', 0);

        $productQueryPagination = $productQuery->clone()->cursorPaginate(24);

//        return $productQuery->count();

        $categoryMap = null;
        $categoryMap = function (Category $category) use ($request, &$categoryMap, $name) {
            $catsArray = $request->post('categories');
            $categoriesIds = Arr::flatten([$request->get('categoryId'), ...$catsArray]);
            $data = [
                'id' => $category->id,
                'name' => $category->name,
                'products_count' => is_null($name)?$category->products_count : $this->getCountCategoryProductsInSearch($category->id, $name),
//                'text' => "$category->name ($category->products_count)",
                'selected' => collect($request->post('categories'))->contains($category->id),
                'checked' => collect($categoriesIds)->contains($category->id),
            ];
            if ($category->relationLoaded('children') && $category->children->count() > 0) {
                $data['children'] = $category->children->map($categoryMap)->values();
                $data['products_count'] = $category->children->map(function ($item) use ($name){
                    return $this->getCountCategoryProductsInSearch($item->id, $name);
                })->sum();
            }
            $data['text'] = "$category->name ({$data['products_count']})";


            return $data;
        };

        $attributesMap = null;

        $attributesMap = function (Attribute $attribute) use ($request, &$attributesMap) {
            $data = [
                'id' => $attribute->id,
                'name' => $attribute->name,
                'products_count' => $attribute->products_count,
                'text' => "$attribute->name ($attribute->products_count)",
                'selected' => collect($request->post('attributes'))->contains($attribute->id),
                'checked' => collect($request->post('attributes'))->contains($attribute->id),
            ];
            if ($attribute->relationLoaded('childes') && $attribute->childes->count() > 0) {
                $data['childes'] = $attribute->childes->map($attributesMap)->values()??[];
            }
            return $data;
        };

        $getCategory = null;

        if ($request->get('categoryId')){
            $getCategory = Category::query()->withCount('products')->find($request->get('categoryId'));
            $$getCategory = (!is_null($name)?($productQuery->count()):$getCategory->products_count);
            $getCategory = "$getCategory->name ( {$$getCategory} )" ;
        }

        return response()->json([
            'success' => true,
            'name' => $name,
            'category_text_name' => $getCategory,
            'filterOptions' => [
                'companies' => $filterOptionsCompanies->map(fn (Manufacturer $manufacturer) => [
                    'id' => $manufacturer->id,
                    'name' => $manufacturer->name,
                    'products_count' => $manufacturer->products_count,
                    'selected' => collect($request->post('companies'))->contains($manufacturer->id),
                ])->values(),
                'categories' => $filterOptionsCategories->map($categoryMap)->values(),
                'attributes' => $filterOptionsAttributes->map($attributesMap)->values(),
                'brands' => $filterOptionsBrands->map(fn (Brand $brand) => [
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'products_count' => $brand->products_count,
                    'selected' => collect($request->post('brands'))->contains($brand->id),
                ])->values(),
                'price_1' => $request->post('price_1'),
                'price_2' => $request->post('price_2'),
//                'prices' => [
//                    $request->post('price_1'), $request->post('price_2')
//                ],
            ],
            'data' => FilteredProductResource::collection($productQueryPagination->items()),
            'pagination' => [
                'total' => $productQuery->count(),
                'next_url' => $productQueryPagination->nextPageUrl(),
                'prev_url' => $productQueryPagination->previousPageUrl(),
            ],
        ]);
    }

    public function checkCategoryQueryRelation(Request $request, $query)
    {
        $name = $request->input('searchName');
        if ($request->has('categories') && is_array($request->post('categories')) && count($request->post('categories')) > 0) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->whereIn('categories.id', $request->post('categories'));
            });
        }
        if (!is_null($name)){
            $query->whereHas('translations', function ($q) use ($name) {
                return $q->where('name', 'like', "%$name%");
            });
        }
//        else if ($request->get('categoryId')){
//            $query->whereHas('categories', function ($query) use ($request) {
//                $query->where('categories.id', $request->get('categoryId'));
//            });
//        }
    }

    private function lngLatQuery(array $data): array
    {
        $circle_radius = 6371;

        return DB::select("
            SELECT
                id,
                seller_id,
                (
                    $circle_radius * ACOS(
                        COS(RADIANS({$data['lat']})) * COS(RADIANS(lat)) * COS(
                            RADIANS(lng) - RADIANS({$data['lng']})
                        ) + SIN(RADIANS({$data['lat']})) * SIN(RADIANS(lat))
                    )
                ) AS DISTANCE
            FROM
                branches
            HAVING
                DISTANCE <= {$data['distance']};
        ");
    }

    public function getCountCategoryProductsInSearch($id, $name){
        $category= Category::query()->with('products',function ($query) use ($name){
            $query->whereHas('images');
            if (!is_null($name)){
                $query->whereHas('translations', function ($q) use ($name) {
                    return $q->where('name', 'like', "%$name%");
                });
            }
        })->find($id);
        return $category->products->count();
    }

    public function show(Request $request, Product $product)
    {
        $product->productAttributes = $product->productAttributesHasQuantity->unique('attribute_id');

        $share = \Share::currentPage()
            ->facebook()
            ->twitter()
            ->whatsapp();
        return view('root.products.show', compact('product', 'share'));
    }

    public function showP(){
        $b = 1;
        $data = [
            'lat'=>	30.0387896,
            'lng'=>	31.2468458,
            'distance' => 10
        ];

        $availableBranches = $this->lngLatQuery($data);
        $branches = array_map(fn ($v) => (array)$v, $availableBranches);

        return Product::query()->has('branch')->get()->filter(function ($product) use ($branches){
            foreach (collect($branches) as $branch):
                if ($branch['id'] == $product->branch->first()->id)
                    return $product;
            endforeach;
        })->count();
    }


}
