<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CategoryProductsController extends Controller
{
    /**
     * Collection of Category Resources
     *
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Category $category): \Illuminate\Http\JsonResponse
    {
        if (!$category->is_active) {
            return ApiHelpers::apiResponse('error', [], 'inactive category');
        }

        $category->load([
            'products' => fn ($q) => $q->where('is_active', 1),
            'products.images'

        ]);

        return ApiHelpers::apiResponse('success', new CategoryResource($category));
    }

    public function products($id){
        $category = Category::query()->find($id);
        if ($category)
        {
            $data = $category->products()->paginate(10);
            return ApiHelpers::paginateResponse(ProductResource::collection($data));
        }
        return ApiHelpers::apiResponse('error', []);
    }
}
