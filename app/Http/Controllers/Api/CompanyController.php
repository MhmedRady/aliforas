<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\ProductResource;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyController extends Controller
{
    public function index(Request $request): JsonResource
    {
        return CompanyResource::collection(Manufacturer::all());
    }

    public function products($id){
        $company = Manufacturer::query()->find($id);
        if ($company)
        {
            $data = $company->products()->paginate(10);
            return ApiHelpers::paginateResponse(ProductResource::collection($data));
        }
        return ApiHelpers::apiResponse('error', []);
    }
}
