<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SellerBranchResource;
use App\Models\Branch;
use App\Models\Auth\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Helpers\ApiHelpers;
use App\Models\Auth\Seller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\HotProductResource;
use App\Http\Resources\FilteredProductResource;
use App\Models\Translations\ProductTranslation;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Collection of Product Resources
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = Product::query()->where('is_active', true)->with(['seller', 'brand', 'branch', 'manufacturer', 'attributesProduct', 'images', 'wishlist'])->find($id);
        if ($data) {
            return $this->returnData(new ProductResource($data));
        } else {
            return ApiHelpers::apiResponse('error', [], 'Sorry this product is not valid.');
        }
    }

    public function is_hot(Request $request)
    {
        $data = Product::query()->where('is_active', 1)
            ->where('is_hot', 1)->paginate(15);
        return $this->returnData($data);
    }

    public function on_sale(Request $request, $onlyData = false)
    {
        $data = Product::query()->with('images')->where('is_active', 1)
            ->where('on_sale', 1)->paginate(15);

        if ($onlyData) {
            return FilteredProductResource::collection($data);
        }
        return $this->returnData($data);
    }

    public function filter(Request $request, $onlyData = false)
    {
//        return $request->has('orderDesc') ? 'order desc' : 'order asc';
        $filterBrandQuery = function ($query) use ($request) {
            if ($request->has('categories') && is_array($request->post('categories')) && count($request->post('categories')) > 0) {
                $query->whereHas('categories', function ($query) use ($request) {
                    $query->whereIn('categories.id', $request->post('categories'));
                });
            }
            if ($request->has('companies') && is_array($request->post('companies')) && count($request->post('companies')) > 0) {
                $query->whereIn('manufacturer_id', $request->post('companies'));
            }
        };
        $filterCompanyQuery = function ($query) use ($request) {
            if ($request->has('categories') && is_array($request->post('categories')) && count($request->post('categories')) > 0) {
                $query->whereHas('categories', function ($query) use ($request) {
                    $query->whereIn('categories.id', $request->post('categories'));
                });
            }
            if ($request->has('brands') && is_array($request->post('brands')) && count($request->post('brands')) > 0) {
                $query->whereIn('brand_id', $request->post('brands'));
            }
        };

        $filterAttributeQuery = function ($query) use ($request) {
            if ($request->has('categories') && is_array($request->post('categories')) && count($request->post('categories')) > 0) {
                $query->whereHas('categories', function ($query) use ($request) {
                    $query->whereIn('categories.id', $request->post('categories'));
                });
            }
//            if ($request->has('attributes') && is_array($request->post('attributes')) && count($request->post('attributes')) > 0)
//                $query->whereIn('attributes.id', $request->post('attributes'));
        };

        $filterOptionsCategories = Category::query()->whereNull('parent_id')
            ->where(function (Builder $query) {
                $query->whereHas('products')
                    ->orWhereHas('children', fn ($q) => $q->whereHas('products')->orWhereHas('children'));
            })->with([
                'children' => fn ($q) => $q->whereHas('products')->orWhereHas('children')->withCount('products')
            ])->withCount('products');
        $filterOptionsBrands = Brand::query()->whereHas('products', $filterBrandQuery)->withCount([
            'products as products_count' => $filterBrandQuery
        ]);
        $filterOptionsCompanies = Manufacturer::query()->whereHas('products', $filterCompanyQuery)->withCount([
            'products as products_count' => $filterCompanyQuery
        ]);

        $filterOptionsSellers = Seller::query()
        ->whereHas('products')
        ->withCount('products')
        ->where('is_active', true);
        $filterOptionsAttributes = Attribute::query()->whereNull('group_id')->where('is_active', true)
            ->whereHas('attrWithProducts', $filterAttributeQuery)->whereHas('childes')
            ->with('childes', fn ($q) => $q->where('is_active', true)->whereHas('attrWithProducts')->withCount('attrWithProducts as products_count'))
            ->withCount(['attrWithProducts as products_count'=>$filterAttributeQuery])
            ->orderByDesc('products_count');

        $filterOptionsCategories = $filterOptionsCategories->limit(100)->get();
        $filterOptionsBrands = $filterOptionsBrands->limit(100)->get();
        $filterOptionsCompanies = $filterOptionsCompanies->limit(100)->get();
        $filterOptionsSellers   = $filterOptionsSellers->limit(100)->get();
        $filterOptionsAttributes = $filterOptionsAttributes->limit(5)->get();

        $productQuery = Product::query()->where('is_active', true)->where('price', '>', 0)->where(function ($query) use ($request) {
            if ($request->has('brands') && is_array($request->post('brands')) && count($request->post('brands')) > 0) {
                $query->whereIn('brand_id', $request->post('brands'));
            }

            if ($request->has('categories') && is_array($request->post('categories')) && count($request->post('categories')) > 0) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('categories.id', array_values($request->post('categories')))
                        ->orWhereIn('categories.parent_id', array_values($request->post('categories')));
                });
            }
            if ($request->has('companies') && is_array($request->post('companies')) && count($request->post('companies')) > 0) {
                $query->whereIn('manufacturer_id', $request->post('companies'));
            }

            if ($request->has('sellers') && is_array($request->post('sellers')) && count($request->post('sellers')) > 0) {
                $query->whereIn('seller_id', $request->post('sellers'));
            }

            if ($request->has('attributes') && is_array($request->post('attributes')) && count($request->post('attributes')) > 0) {
                $query->whereHas('attributes', function ($q) use ($request) {
                    return $q->whereIn('attributes.id', $request->post('attributes'));
                });
            }
            if ($request->has('search')) {
                $query->whereHas('translations', function ($q) use ($request) {
                    $q->where('name', 'like', "%{$request->search}%");
                });
            }

            if ($request->has('lat') && $request->has('lng') && $request->has('distance')){

            }

        })->with(['images' /*=> function ($q) {
            $q->limit(2);
        }*/, 'brand']);
        if ($request->get('isHot')) {
            $productQuery->where('is_hot', 1);
        }

        if ($request->get('onSale')) {
            $productQuery->where('on_sale', 1);
        }

        if ($request->get('price')) {
            $productQuery->whereBetween('price', $request->get('price'));
        }

        if ($request->has('show_for') && in_array($request->show_for, ['male', 'female', 'both'])) {
            $productQuery->where('show_for', $request->show_for);
        }

        if ($request->has('categories') && $request->has('brands'))
        {
            if ($request->has('lat') && $request->has('lng') && $request->has('distance'))
                $productQuery->whereNotNull('seller_id')->has('branch');
        }

        if ($request->has('orderDesc') && !$request->post('orderDesc')){
            $productQuery->orderBy('price');
        }else{
            $productQuery->orderByDesc('price');
        }

        $productQueryPagination = $productQuery->clone()->paginate(24);

        if ($request->has('categories') && $request->has('brands')){
            if ($request->has('lat') && $request->has('lng') && $request->has('distance')){
                $data = [
                    'lat'=>	$request->post('lat'),
                    'lng'=>	$request->post('lng'),
                    'distance' => $request->post('distance')
                ];
                $availableBranches = $this->lngLatQuery($data);
                $branches = array_map(fn ($v) => (array)$v, $availableBranches);

                $productQueryPagination->filter(function ($product) use ($branches){
                    foreach (collect($branches) as $branch):
                        if ($branch['id'] == $product->branch->first()->id)
                            return $product;
                    endforeach;
                });
            }
        }

        $categoryMap = null;

        $categoryMap = function (Category $category) use ($request, &$categoryMap) {
            $data = [
                'id' => $category->id,
                'name' => $category->name,
                'products_count' => $category->products_count,
                'text' => "$category->name ($category->products_count)",
                'selected' => collect($request->post('categories'))->contains($category->id),
                'checked' => collect($request->post('categories'))->contains($category->id),
            ];
            if ($category->relationLoaded('children') && $category->children->count() > 0) {
                $data['children'] = $category->children->map($categoryMap)->values();

                $data['products_count'] = $category->children->map(function ($item){
                    return $item->products_count;
                })->sum();

                $data['text'] = "$category->name ({$data['products_count']})";
            }
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

        $brands = $filterOptionsBrands->map(fn (Brand $brand) => [
            'id' => $brand->id,
            'name' => $brand->name,
            'quickView' => $brand->logo_thumb,
            'products_count' => $brand->products_count,
            'selected' => collect($request->post('brands'))->contains($brand->id),
        ])->values();

        if ($onlyData) {
            return [
                'products' =>   FilteredProductResource::collection($productQueryPagination->items()),
                'brands' =>   $brands
            ];
        }

        return response()->json([
            'success' => true,
            'filterOptions' => [
                'companies' => $filterOptionsCompanies->map(fn (Manufacturer $manufacturer) => [
                    'id' => $manufacturer->id,
                    'name' => $manufacturer->name,
                    'products_count' => $manufacturer->products_count,
                    'selected' => collect($request->post('companies'))->contains($manufacturer->id),
                ])->values(),
                'categories' => $filterOptionsCategories->map($categoryMap)->values(),
                'sellers' => SellerResource::collection($filterOptionsSellers),
                'attributes' => $filterOptionsAttributes->map($attributesMap)->values(),
                'brands' => $brands,
            ],
            'data' => FilteredProductResource::collection($productQueryPagination->items()),
            'pagination' => [
                'total' => $productQuery->count(),
                'next_url' => $productQueryPagination->nextPageUrl(),
            ],
        ]);
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

    public function returnData($data)
    {
        return ApiHelpers::apiResponse('success', $data);
    }

    public function viewProduct(Request $request)
    {
        $data = $request->validate([
            'user_id'   =>  'required|exists:users,id',
            'product_id'=>  'required|exists:products,id'
        ]);

        $client = User::find($request->user_id);

        if (! $client) {
            return ApiHelpers::apiResponse('error', [], 'The User is Invalid or Not a Customer.');
        }

        $client->viewedProducts()->attach($request->product_id);
        return ApiHelpers::apiResponse('success', [], 'Success.');
    }

    public function viewedProducts(Request $request, $onlyData = false)
    {
        if (!$request->has('user_id') && $onlyData) {
            return [];
        }

        $request->validate([
            'user_id'   =>  'required|exists:users,id',
        ]);


        if (! $client = User::find($request->user_id)) {
            return ApiHelpers::apiResponse('error', [], 'The User is Invalid or Not a Customer.');
        }

        $data = $client->viewedProducts->unique()->take(10);

        if ($onlyData) {
            return FilteredProductResource::collection($data);
        }

        return $this->returnData(ProductResource::collection($data));
    }

    public function latestTen(Request $request, $onlyData = false)
    {
        $productQuery = Product::query()
        ->where('is_active', true)
        ->with(['images', 'brand'])
        ->orderBy('id', 'DESC')
        ->take(10)
        ->get();

        if ($onlyData) {
            return FilteredProductResource::collection($productQuery);
        }

        return $this->returnData(FilteredProductResource::collection($productQuery));
    }

    public function search(Request $request): JsonResponse
    {
        $matchingIds = ProductTranslation::where(fn ($q) => $q->where('name', 'like', '%' . $request->search . '%'))
        ->get()
        ->pluck('product_id')
        ->unique()
        ->toArray();

        $productQuery = Product::query()->where('is_active', true)->whereIn('id', $matchingIds)->with(['images', 'brand']);
        $productQueryPagination = $productQuery->clone()->paginate(24);

        return response()->json([
            'success' => true,
            'data' => FilteredProductResource::collection($productQueryPagination->items()),
            'pagination' => [
                'total' => $productQuery->count(),
                'next_url' => $productQueryPagination->nextPageUrl(),
            ],
        ]);
    }

    public function related($id)
    {
        $product = Product::query()->find($id);
        if ($product) {
            $data = $product->categories->first()->products()->paginate(10);
            if ($data->count()) {
                return ApiHelpers::paginateResponse(FilteredProductResource::collection($data));
            }
            $data = $product->brand->first()->products()->paginate(10);
            if ($data->count()) {
                return ApiHelpers::paginateResponse(FilteredProductResource::collection($data));
            }

            $data = $product->manufacturer->first()->products()->paginate(10);
            if ($data->count()) {
                return ApiHelpers::paginateResponse(FilteredProductResource::collection($data));
            }
        }

        return ApiHelpers::apiResponse('error', [], __('layouts.productNotExist'));
    }

    public function viewProductBranch($id)
    {
        $product = Product::query()->find($id);

        if ($product){
            if ($product->branch->count()) {
                $branch = $product->branch->first();
                $views = $branch->views;
                $$views = $views + 1;
                $branch->update(['views'=>$$views, 'lastViews'=>$views, 'shown'=> false]);
                return ApiHelpers::apiResponse('success', ['views'=>$$views], __('auth.successUpdate', ['var'=>__('layouts.tBranch')]));
            }
            return ApiHelpers::apiResponse('error', [], 'This product does not belong to any branch');
        }

        return ApiHelpers::apiResponse('error', [], __('layouts.productNotExist'));
    }

    public function branchWithProducts($id) {
        $branch = Branch::query()->find($id);
        if ($branch)
        {
            return $this->returnData(new SellerBranchResource($branch));
        }
        return ApiHelpers::apiResponse('error', [], 'this Branch is not exist!');
    }
}
