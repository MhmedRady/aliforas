<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartItemResource;
use App\Models\Product;
use App\Http\Requests\OrderCheckoutRequest;
use Illuminate\Http\Request;
use App\Models\State;
use App\Helpers\Helper;
use App\Jobs\NewPricesRequest;

use App\Repositories\OrderRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

use App\Models\PriceQuoteOrder;
use App\Models\PriceQuoteOrderItem;
use App\Models\UserAddress;
use App\Notifications\Mail\NewOrderPrices;

use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function addItem(Request $request, Product $product)
    {
        $itemId = 'product_' . $product->id;
        $attributes = [];
        if ($request->attribute == 0){
            $itemId = 'product_' . $product->id;
            $name = $product->name;
        }else{
            $itemId = 'product_' . $product->id.'_'.$request->attribute;
            $attribute = $this->getCartAttributes($product, $request);
            $attributes[] = $attribute['attribute'];
            $product->price = $attribute['price'];
            $name = $product->name;
        }
        if (userCart()->has($itemId)) {
            userCart()->update($itemId, [
                'quantity' => intval($request->post('quantity', 1)),
                'price' => $product->price,
                'attributes' => $attributes,
            ]);
        } else {
            userCart()->add([
                'id' => $itemId,
                'name' => $name,
                'price' => config('setting.pricing') === true ? $product->price : 1,
                'quantity' => intval($request->post('quantity', 1)),
                'attributes' => $attributes,
                'associatedModel' => $product
            ]);
        }
        return response()->json([
            'success' => true,
            'cart' => [
                'items' => CartItemResource::collection(userCart()->getContent()),
                'count' => userCart()->getTotalQuantity(),
            ]
        ]);
    }

    public function getCartAttributes($product,$request)
    {
        $attr = $product->attributesProduct()->find($request->post('attribute', 0));
        $name = $product->name;
        if ($attr)
        {
            $product->price = $attr->price;
            $name = $product->name;
        }
        return ['attribute' => $attr, 'price' => $product->price, 'name' => $name];
    }

    public function deleteItem(Product $product)
    {
        $itemId = 'product_' . $product->id;
        if (userCart()->has($itemId))
            userCart()->remove($itemId);
        return response()->json([
            'success' => true,
            'cart' => [
                'items' => CartItemResource::collection(userCart()->getContent()),
                'count' => userCart()->getTotalQuantity(),
            ]
        ]);
    }

    public function view(Request $request)
    {
//        return userCart()->getContent();
        $totalPrices = Helper::getTotalPrices();
//        return $totalPrices;
        return view('root.cart.index',compact('totalPrices'));
    }

    public function updateItemQuantity(Request $request)
    {
        $itemId = $request->item_id;
        $item = userCart()->get($itemId);
        $product_id = $item->associatedModel->id;
        $product = Product::find($product_id);

        if (userCart()->has($itemId)&&$product) {
            $stock = $item->associatedModel->stock;
//            if ($request->quantity < $stock) {
            userCart()->remove($itemId);
            userCart()->add([
                'id' => $itemId,
                'name' => $item->name,
                'price' => config('setting.pricing') === true ? $item->price : 1,
                'quantity' => intval($request->quantity),
                'attributes' => $item->attributes,
                'associatedModel' => $product
            ]);
//                userCart()->update($itemId, [
//                    'quantity' => $request->quantity,
//                ]);

                return response()->json(['tag' => true,
                    'sub_prices' => Helper::getTotalPrices()['sub_total'],
                    'msg' => __('layouts.quantitySuccess'),
                    'cartCount' => userCart()->getTotalQuantity()]);
//            } else {
//                return response()->json(['tag' => false, 'msg' => __('layouts.quantityError')]);
//            }
        } else {
            return response()->json(['tag' => false, 'msg' => __('layouts.cartNotExist')]);
        }
    }

    function getTotalPrices()
    {
        return Helper::getTotalPrices();
    }

    function cartRemoveItem($item_id)
    {
        if (userCart()->has($item_id)){
            userCart()->remove($item_id);
        }
        return redirect()->route('cart.view');
    }
}
