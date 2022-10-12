<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function slider()
    {
        $slider = Slider::query()->where('is_active', true)->orderByDesc('id')->get();
        return ApiHelpers::apiResponse('success', SliderResource::collection($slider));
    }

    public function banner()
    {
        $slider = Slider::query()->where([['is_active', true], ['is_banner', 'true']])->get();
        return ApiHelpers::apiResponse('success', SliderResource::collection($slider));
    }
}
