<?php

namespace App\Repositories;

use App\Http\Requests\OrderCheckoutRequest;
use App\Models\Order;
use App\Models\OrderProduct;

use App\Models\OrderStatus;
use App\Models\PriceQuoteOrder;
use App\Models\PriceQuoteOrderItem;
use App\Models\State;
use App\Models\User;
use App\Helpers\Helper;

use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class OrderRepository extends BaseRepository
{
    public function model()
    {
        return Order::class;
    }

    public function store(OrderCheckoutRequest $request)
    {
        if (Auth::guard('web')->check()) {
            /** @var User $user */
            $user = auth()->guard('web')->user();
            if ($request->has('user_address_id')) {
                $userAddressId = $request->post('user_address_id');
            } else {
                $userAddress = [
                    'user_id' => $user->id,
                    'first_name' => $request->post('first_name'),
                    'last_name' => $request->post('last_name'),
                    'phone' => $request->post('phone'),
                    'email' => $user->email,
                    'postal_code' => $request->post('postal_code'),
                    'address' => $request->post('address'),
                    'state_id' => $request->post('state_id'),
                    'city_id' => $request->post('city_id'),
                ];
                $userAddress = $user->userAddresses()->create($userAddress);
                $userAddressId = $userAddress->id;
            }
            if (config('setting.pricing') === true) {
                $state = State::query()->findOrFail($request->input('state_id', 1));
                $totalPrices = Helper::getTotalOrderWithWeight($state->zone_list->first()->cod_values??0, $state->zone_list->first()->first_kg??0, $state->zone_list->first()->additional_kg??0);

                $order = Order::query()->create([
                'user_address_id'=> $userAddressId,
                'user_id'=> \auth()->guard('web')->id(),
                'total' => $totalPrices['total'],
                'shipping_zone_id' => $state->zone_list->first()->id,
                'weights' => $totalPrices['weight'],
                'shipping_amount' => $totalPrices['sipping'],
            ]);

                if (userCart()->getTotalQuantity() > 0) {
                    foreach (userCart()->getContent() as $item) {
                        $attribute_id = 0;
                        if ($item->attributes->count()) {
                            $attribute_id = $item->attributes[0]['id'];
                        }
                        OrderProduct::query()->create([
                        'seller_id' => $item->associatedModel->seller_id,
                        'product_id' => $item->associatedModel->id,
                        'attribute_id' => $attribute_id,
                        'price' => $item->price,
                        'total' => ($item->quantity * $item->price),
                        'quantity' => $item->quantity,
                        'order_id' => $order->id
                    ]);
                    }
                }
            } else {
                $PriceQuoteOrder = PriceQuoteOrder::query()->create([
                    'user_id' => \auth()->guard('web')->id(),
                    'status_id' => optional(OrderStatus::query()->where('type', 'new')->first())->id,
                    'user_address_id' => $userAddressId,
                ]);

                foreach (userCart()->getContent() as $item) {
                    PriceQuoteOrderItem::query()->create([
                        'product_id' => $item->associatedModel->id,
                        'price' => $item->price,
                        'total' => ($item->quantity * $item->price),
                        'quantity' => $item->quantity,
                        'price_quote_order_id' => $PriceQuoteOrder->id
                    ]);
                }
            }
        } else {
            //todo add guest order option
            /*$userAddress = [
                'state_id' => $request->input('state_id'),
                'city_id' => $request->input('city_id'),
                'address' => $request->input('address'),
                'postal_code' => $request->input('postal_code'),
            ];

            $userAddress_id = UserAddress::query()->create($userAddress);

            $PriceQuoteOrder = [
                'user_address_id' => $userAddress_id->id,
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('first_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ];
            $PriceQuoteOrder_id = PriceQuoteOrder::query()->create($PriceQuoteOrder);
            foreach (userCart()->getContent() as $item) {
                PriceQuoteOrderItem::query()->create([
                    'product_id' => $item->associatedModel->id,
                    'quantity' => $item->quantity,
                    'price_quote_order_id' => $PriceQuoteOrder_id->id
                ]);
            }*/
        }
    }

    public function apiStore(OrderCheckoutRequest $request)
    {
        $user = auth()->user();

        if (request()->post('branch_id') && !is_null(request()->post('branch_id'))){
            $userAddressId = null;
            $branchId = $request->post('branch_id');
        }else{
            if ($request->has('user_address_id')) {
                $userAddressId = $request->post('user_address_id');
            } else {
                $userAddress = $user->userAddresses()->create([
                    'user_id' => $user->id,
                    'first_name' => $request->post('first_name'),
                    'last_name' => $request->post('last_name'),
                    'phone' => $request->post('phone'),
                    'email' => $user->email,
                    'postal_code' => $request->post('postal_code'),
                    'address' => $request->post('address'),
                    'state_id' => $request->post('state_id'),
                    'city_id' => $request->post('city_id'),
                ]);

                $userAddressId = $userAddress->id;
            }
        }

        $state = State::query()->findOrFail($request->input('state_id', 1));

        if (config('setting.pricing') === true) {
            $totalPrices = Helper::getTotalOrderWithWeightApi($state->zone_list->first()->cod_values ?? 0, $state->zone_list->first()->first_kg ?? 0, $state->zone_list->first()->additional_kg ?? 0);

            $order = Order::query()->create([
                'user_address_id'=> $userAddressId,
                'branch_id'=> $request->post('branch_id'),
                'user_id'=> auth()->user()->id,
                'total' => $totalPrices['total'],
                'shipping_zone_id' => $state->zone_list->first()['id'] ?? null,
                'weights' => $totalPrices['weight'],
                'shipping_amount' => is_null(request()->post('branch_id')) ? $totalPrices['sipping']:0,
            ]);

            if (apiUserCart()->getTotalQuantity() > 0) {
                foreach (apiUserCart()->getContent() as $item) {
                    $attribute_id = 0;
                    if ($item->attributes->count()) {
                        $attribute_id = $item->attributes[0]['id'];
                    }
                    OrderProduct::query()->create([
                            'seller_id' => $item->associatedModel->seller_id,
                            'product_id' => $item->associatedModel->id,
                            'attribute_id' => $attribute_id,
                            'price' => $item->last()->price,
                            'total' => ($item->quantity * $item->last()->price),
                            'quantity' => $item->quantity,
                            'order_id' => $order->id
                        ]);
                }
            }
        }else {
            $PriceQuoteOrder = PriceQuoteOrder::query()->create([
                'user_id' => $user->id,
                'email' => $user->email,
                'status_id' => optional(OrderStatus::query()->where('type', 'new')->first())->id,
                'user_address_id' => $userAddressId,
            ]);

            foreach (apiUserCart()->getContent() as $item) {
                PriceQuoteOrderItem::query()->create([
                    'product_id' => $item->associatedModel->id,
                    'price' => $item->price,
                    'total' => ($item->quantity * $item->price),
                    'quantity' => $item->quantity,
                    'price_quote_order_id' => $PriceQuoteOrder->id
                ]);
            }
        }
    }

//    public function store($request)
//    {
//
//        if (Auth::guard('web')->check()){
//
//            $userAddress = [
//                'user_id'=>auth()->user()->id,
//                'state_id'=>$request->input('state_id'),
//                'city_id'=>$request->input('city_id'),
//                'address'=>$request->input('address'),
//                'postal_code'=>$request->input('postal_code'),
//            ];
//
//            auth()->user()->userAddress->update($userAddress);
//
//            $PriceQuoteOrder = [
//                'user_id'=>auth()->user()->id,
//                'user_address_id'=>auth()->user()->userAddress->id,
//                'first_name' =>$request->input('first_name'),
//                'last_name' =>$request->input('first_name'),
//                'email' =>$request->input('email'),
//                'phone' =>$request->input('phone'),
//            ];
//
//            $PriceQuoteOrder_id = PriceQuoteOrder::query()->insertGetId($PriceQuoteOrder);
//
//            foreach (userCart()->getContent() as $item)
//            {
//                PriceQuoteOrderItem::query()->create([
//                    'product_id'=>$item->associatedModel->id,
//                    'quantity'=>$item->quantity,
//                    'price_quote_order_id'=>$PriceQuoteOrder_id
//                ]);
//            }
//
//        }else{
//
//            $userAddress = [
//                'state_id'=>$request->input('state_id'),
//                'city_id'=>$request->input('city_id'),
//                'address'=>$request->input('address'),
//                'postal_code'=>$request->input('postal_code'),
//            ];
//            $userAddress_id = UserAddress::query()->insertGetId($userAddress);
//            $PriceQuoteOrder = [
//                'user_address_id'=>$userAddress_id,
//                'first_name' =>$request->input('first_name'),
//                'last_name' =>$request->input('first_name'),
//                'email' =>$request->input('email'),
//                'phone' =>$request->input('phone'),
//            ];
//            $PriceQuoteOrder_id = PriceQuoteOrder::query()->insertGetId($PriceQuoteOrder);
//            foreach (userCart()->getContent() as $item)
//            {
//                PriceQuoteOrderItem::query()->create([
//                    'product_id'=>$item->associatedModel->id,
//                    'quantity'=>$item->quantity->id,
//                    'price_quote_order_id'=>$PriceQuoteOrder_id
//                ]);
//            }
//        }
//
//    }
}
