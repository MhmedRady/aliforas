<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandsController extends Controller
{
    /**
    * Collection of Category Resources
    *
    * @param Request $request
    * @return JsonResource
    */
    public function index(Request $request): JsonResource
    {
        return BrandResource::collection(Brand::all());
    }

    public function products($id){
        $brand = Brand::query()->find($id);
        if ($brand)
        {
            $data = $brand->products()->paginate(10);
            return ApiHelpers::paginateResponse(ProductResource::collection($data));
        }
        return ApiHelpers::apiResponse('error', []);
    }
}
