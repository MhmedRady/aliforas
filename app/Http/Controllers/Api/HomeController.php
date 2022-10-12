<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MainSettingResource;
use App\Models\MainSetting;
use App\Models\Page;
use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Product;
use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessageRequest;
use App\Http\Resources\FilteredProductWithBannerResource;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $response = [];

        $bannerProducts = Product::query()
        ->whereHas('sliders', fn ($q) => $q->where('is_banner', 1)->where('is_active', true))
        ->with(['images', 'brand', 'sliders' => fn ($q) => $q->where('is_banner', 1)->where('is_active', true)])
        ->where('is_active', true)
        ->orderBy('id', 'DESC')
        ->get();

        $sliderProducts = Product::query()
        ->whereHas('sliders', fn ($q) => $q->where('is_banner', '!=', 1)->where('is_active', true))
        ->with(['images', 'brand', 'sliders'=> fn ($q) => $q->where('is_banner', '!=', 1)->where('is_active', true)])
        ->where('is_active', true)
        ->orderBy('id', 'DESC')
        ->get();

        $productController      = new ProductsController();
        $filter = $productController->filter($request, true);

        $response['banners']    = FilteredProductWithBannerResource::collection($bannerProducts);
        $response['sliders']    = FilteredProductWithBannerResource::collection($sliderProducts);
        $response['sale']       = $productController->on_sale($request, true);
        $response['latest']     = $productController->latestTen($request, true);
        $response['viewed']     = $productController->viewedProducts($request, true);
        $response['gendered']   = $filter['products'];
        $response['brands']     = $filter['brands'];

        return ApiHelpers::apiResponse('success', $response);
    }

    public function preferences(Request $request): JsonResponse
    {
        $response = [];
        $name = (request()->hasHeader('accept-language') && request()->header('accept-language') == 'ar-EG')? optional(Page::query()->where('is_active', 1)->first()->translate('ar'))->body : optional(Page::query()->where('is_active', 1)->first()->translate('en'))->body;
        $response['about'] = $name;
        return ApiHelpers::apiResponse('success', $response);
    }

    public function sendContactMessage(ContactMessageRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            Contact::query()->create($request->except(['_token']));
            DB::commit();
            return ApiHelpers::apiResponse('success');
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiHelpers::apiResponse('error');
        }
    }


    public function mainSetting(): JsonResponse
    {
        return ApiHelpers::apiResponse('success', MainSettingResource::make( MainSetting::query()->get()));
    }
}
