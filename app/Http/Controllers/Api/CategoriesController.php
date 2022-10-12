<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiHelpers;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    /**
     * Collection of Category Resources
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $categories = Category::query()->where('is_active', 1)->whereNull('parent_id');
        return $this->returnData($categories, $request->get('paginate'));
    }

    /**
     * Collection of Category Resources
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function parent_categories(Request $request): \Illuminate\Http\JsonResponse
    {
        $categories = Category::query()->where('is_active', 1)->whereNull('parent_id')->withCount('activeChildes');
        return $this->returnData($categories, $request->get('paginate'));
    }

    /**
     * Collection of Category Resources
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function child_categories(Request $request)
    {
        $categories = Category::query()->with('parent')->where('is_active', true)->whereNotNull('parent_id');
        return $this->returnData($categories, $request->get('paginate'));
    }

    public function category_children(Request $request)
    {
        $categories = Category::query()->with('parent')->where('is_active', true)->where('parent_id', $request->get('category_id', 1));
        return $this->returnData($categories, $request->get('paginate'));
    }

    protected function returnData($data, $paginate = true, $status = 'success')
    {
        if ($paginate) {
            $collection = $data->paginate(5);
            $data = $collection->getCollection();
            $more = $collection->hasMorePages();
            $total = $collection->total();
        } else {
            $data = $data->get() ;
            $total = $data->count();
            $more = false;
        }
        return new JsonResponse(
            [
                'status' => $status,
                'data' => CategoryResource::collection($data),
                'total' => $total,
                'more' => $more
            ],
            Response::HTTP_OK
        );
    }
}
