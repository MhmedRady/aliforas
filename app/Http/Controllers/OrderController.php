<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\MainSetting;
use App\Models\ShippingZone;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Order;
use App\Http\Requests\OrderCheckoutRequest;
use App\Repositories\OrderRepository;

use App\Models\State;
use App\Helpers\Helper;
use App\Jobs\NewPricesRequest;

use App\Models\PriceQuoteOrder;

class OrderController extends Controller
{
    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \auth()->user();
        return view('root.auth.profileTabs.myOrders', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function viewOrderPrices(Request $request, $order)
    {
        $user = \auth()->guard('web')->user();
        $order = Order::query()->where('user_id', $user->id)->findOrFail($order);

        return view('root.auth.orderPricesTable', compact('order'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //        return Helper::getTotalOrderWithWeight(8,2);
        //        return ShippingZone::query()->find(1);
        $states = State::query()->get();
        $totalPrices = Helper::getTotalPrices();
        return view('root.cart.checkout', compact('states', 'totalPrices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderCheckoutRequest $request)
    {
        $request->merge([
            'total'=>Helper::getTotalPrices()['total']??0,
        ]);

        try {
            DB::beginTransaction();
            $this->orderRepository->store($request);
            DB::commit();
            try {
                NewPricesRequest::dispatch(\auth()->user())->delay(\Carbon\Carbon::now()->addSeconds(5));
            } catch (\Exception $e) {
            }
            userCart()->clear();
            return redirect()->route('order.success');
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('order.error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
        $user = auth()->guard('web')->user();
        if (config('setting.pricing')) {
            $order = Order::query()->where('user_id', $user->id)->findOrFail($order);
            ;
        } else {
            $order = PriceQuoteOrder::query()->where('user_id', $user->id)->findOrFail($order);
            ;
        }
        return view('root.auth.orderPricesTable', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function successOrder()
    {
        return view('root.cart.order-success');
    }

    public function errorOrder()
    {
        return view('root.cart.order-success');
    }

    public function viewOrderWithShipping(OrderCheckoutRequest $order)
    {
//        return userCart()->getContent()->first()->attributes[0]['attribute_id'];

        if ($order->has('user_address_id')) {
            $userAddress = auth()->user()->userAddresses->find($order->input('user_address_id'));
            $order->merge([
                'first_name' => $userAddress->first_name,
                'last_name' => $userAddress->last_name,
                'phone' => $userAddress->phone,
                'state_id' => $userAddress->state_id,
                'city_id' => $userAddress->city_id,
                'address' => $userAddress->address,
                'postal_code' => $userAddress->postal_code,
            ]);
        }
        $tax = MainSetting::query()->where('key', 'taxes')->first();
        $state = State::query()->findOrFail($order->input('state_id', 1));
        if (!$state->zone_list->count()) {
            return redirect()->route('cart.checkout')->with(['error'=> __('layouts.noZone')]);
        }

        $totalPrices = Helper::getTotalOrderWithWeight($state->zone_list->first()->cod_values??0, $state->zone_list->first()->first_kg??0, $state->zone_list->first()->additional_kg??0);

        return view('root.cart.checkOutWithSipping', compact('order', 'totalPrices', 'state', 'tax'));
    }
}
