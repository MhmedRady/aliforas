<?php

namespace App\Http\Controllers\Api;

use App\Models\Auth\User;
use App\Models\Wishlist;
use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;

class WishlistController extends Controller
{
    public function index(): JsonResponse
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->latest()->get();
        return ApiHelpers::apiResponse('success', WishlistResource::collection($wishlists));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'product_id'=>  'required|exists:products,id'
        ]);

        if (! $client = User::find(auth()->user()->id)) {
            return ApiHelpers::apiResponse('error', [], 'The User is Invalid or Not a Customer.');
        }

        $existing = Wishlist::where('product_id', $request->product_id)->where('user_id', auth()->user()->id)->count() > 0;
        if ($existing) {
            return ApiHelpers::apiResponse('error', [], 'Item Already Exists In your Wishlist.');
        }

        $data['user_id'] = $client->id;

        $wishlist = Wishlist::create($data);
        return ApiHelpers::apiResponse('success', new WishlistResource($wishlist));
    }

    public function destroy($id): JsonResponse
    {
        if (!$wishlist = Wishlist::query()->where('user_id', auth()->user()->id)->find($id)) {
            return ApiHelpers::apiResponse('error', [], 'Not Found Entity.');
        }

        $wishlist->delete();
        return ApiHelpers::apiResponse('success', [], null);
    }
}
