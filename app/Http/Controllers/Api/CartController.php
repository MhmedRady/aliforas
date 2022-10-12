<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Models\Product;
use App\Helpers\ApiHelpers;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemApiResource;

class CartController extends Controller
{
    public function addItem(Request $request, Product $product)
    {
        $request->validate([
            'quantity'  =>  'required|numeric|min:0',
            'attribute' =>  'nullable'
        ]);

        $itemId = 'product_' . $product->id;
        $attributes = [];
        if ($request->attribute == 0) {
            $itemId = 'product_' . $product->id;
            $name = $product->name;
        } else {
            $itemId = 'product_' . $product->id.'_'.$request->attribute;
            $attribute = $this->getCartAttributes($product, $request);
            $attributes[] = $attribute['attribute'];
            $product->price = $attribute['price'];
            $name = $product->name;
        }

        if (apiUserCart()->has($itemId)) {
            apiUserCart()->update($itemId, [
                'quantity' => intval($request->post('quantity', 1)),
                'price' => $product->price,
                'attributes' => $attributes,
            ]);
        } else {
            apiUserCart()->add([
                'id' => $itemId,
                'name' => $name,
//                'price' => config('setting.pricing') === true ? $product->price : 1,
                'price' =>  $product->price,
                'quantity' => intval($request->post('quantity', 1)),
                'attributes' => $attributes,
                'associatedModel' => $product
            ]);
        }
            $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', auth()->user()->id)->first();
        if ($wishlist)
            $wishlist->delete();


        $cart = [
            'items' => CartItemApiResource::collection(apiUserCart()->getContent()),
            'count' => apiUserCart()->getTotalQuantity(),
        ];

        return ApiHelpers::apiResponse('success', ['cart' => $cart ], null);
    }

    public function getCartAttributes($product, $request)
    {
        $attr = $product->attributesProduct()->find($request->post('attribute', 0));
        $name = $product->name;
        if ($attr) {
            $product->price = $attr->price;
            $name = $product->name;
        }
        return ['attribute' => $attr, 'price' => $product->price, 'name' => $name];
    }

    public function deleteItem($item_id): JsonResponse
    {
        if (! $product = Product::find($item_id)) {
            return ApiHelpers::apiResponse('error', [], 'Item Not Found.');
        }

        $itemId = 'product_' . $product->id;

        if (! apiUserCart()->has($itemId)) {
            return ApiHelpers::apiResponse('error', [], 'Item Not Found.');
        }

        apiUserCart()->remove($itemId);
        $cart = [
            'items' => CartItemApiResource::collection(apiUserCart()->getContent()->values()),
            'count' => apiUserCart()->getTotalQuantity(),
        ];
        return ApiHelpers::apiResponse('success', $cart, null);
    }

    public function view(Request $request): JsonResponse
    {
        $cart =
            [
                'items' => CartItemApiResource::collection(apiUserCart()->getContent()->values()),
                'count' => apiUserCart()->getTotalQuantity(),
            ];
        if (config('setting.pricing'))
            $cart['sub_prices'] = Helper::getTotalPricesApi()['sub_total'];

        return ApiHelpers::apiResponse('success', $cart, null);
    }

    public function updateItemQuantity(Request $request, $id): JsonResponse
    {
        $request->validate([
            'quantity'  =>  'required|numeric|min:1'
        ]);

        $itemId = 'product_' . $id;
        $item = apiUserCart()->get($itemId);

        if (! $item) {
            return ApiHelpers::apiResponse('error', [], 'Item Not Found.');
        }

        $product_id = $item->associatedModel->id;
        $product = Product::find($product_id);

        if (apiUserCart()->has($itemId) && $product) {
            apiUserCart()->remove($itemId);
            apiUserCart()->add([
                'id' => $itemId,
                'name' => $item->name,
                'price' => config('setting.pricing') === true ? $item->price : 1,
                'quantity' => intval($request->quantity),
                'attributes' => $item->attributes,
                'associatedModel' => $product
            ]);

            return ApiHelpers::apiResponse(
                'success',
                [
                    'tag' => true,
                    'sub_prices' => Helper::getTotalPricesApi()['sub_total'],
                    'msg' => __('layouts.quantitySuccess'),
                    'cartCount' => apiUserCart()->getTotalQuantity()
                ],
                null
            );
        } else {
            return ApiHelpers::apiResponse('success', ['tag' => false], __('layouts.cartNotExist'));
        }
    }

    public function getTotalPrices()
    {
        return ApiHelpers::apiResponse('success', Helper::getTotalPricesApi(), null);
    }

    public function clearCart(): JsonResponse
    {
        if (apiUserCart()->getContent()->count() == 0) {
            return ApiHelpers::apiResponse('error', [], 'No Items Found in Cart.');
        }

        apiUserCart()->clear();

        $cart = [
            'items' => CartItemApiResource::collection(apiUserCart()->getContent()->values()),
            'count' => apiUserCart()->getTotalQuantity(),
        ];
        return ApiHelpers::apiResponse('success', $cart, null);
    }

}
