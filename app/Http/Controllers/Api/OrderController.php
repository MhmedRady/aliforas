<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Order;
use App\Helpers\Helper;
use App\Helpers\ApiHelpers;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Jobs\NewPricesRequest;
use App\Models\PriceQuoteOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepository;
use App\Http\Resources\AddressResource;
use App\Http\Controllers\Api\FCMController;
use App\Http\Requests\OrderCheckoutRequest;

class OrderController extends Controller
{
    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function store(OrderCheckoutRequest $request)
    {
        if (apiUserCart()->getContent()->count() == 0) {
            return ApiHelpers::apiResponse('error', [], 'No Items in your Cart, Failed to make an Order.');
        }

        $request->merge([
            'total' =>  Helper::getTotalPricesApi()['total'] ?? 0,
        ]);

        try {
            DB::beginTransaction();
                $this->orderRepository->apiStore($request);
            DB::commit();
            try {
                NewPricesRequest::dispatch(\auth()->user())->delay(\Carbon\Carbon::now()->addSeconds(5));
                FCMController::sendNotification(auth()->user()->id, 1);
            } catch (\Exception $e) {
            }

            apiUserCart()->clear();
            return ApiHelpers::apiResponse('success', [],  __('layouts.orderSuccessMsg', ['var' =>  $request->total]));
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return ApiHelpers::apiResponse('error', [], $e->getMessage());
        }
    }

    public function userOrders(Request $request): JsonResponse
    {

        $excludedStatusIds = OrderStatus::where('type', 'cancelled')->orWhere('type', 'declined')->pluck('id')->toArray();
        $user = auth()->user();
        $orders = $user->userOrders->load('orderProduct.product')->whereNotIn('status_id', $excludedStatusIds);
//        $orders = Order::query()->whereNotNull('branch_id')->get();
//        return ApiHelpers::apiResponse('success', $orders->first()->branch, null);

        return ApiHelpers::apiResponse('success', OrderResource::collection($orders));
    }

    public function viewOrder($order)
    {
        $user = auth()->user();
        if (config('setting.pricing'))
            $order = Order::query()->where('user_id', $user->id)->findOrFail($order);
        else
            $order = PriceQuoteOrder::query()->where('user_id', $user->id)->findOrFail($order);
        return ApiHelpers::apiResponse('success', new OrderResource($order->load('orderProduct.product')), null);
    }

    public function cancelOrder($order)
    {
        $user = auth()->user();
        $canceledStatus = OrderStatus::where('type', 'cancelled')->first();
        if (config('setting.pricing'))
            $order = Order::query()->where('user_id', $user->id)->findOrFail($order);
        else
            $order = PriceQuoteOrder::query()->where('user_id', $user->id)->findOrFail($order);
        $order->status_id   = $canceledStatus->id;
        $order->save();

        FCMController::sendNotification($order->user_id, $order->status_id);

        return ApiHelpers::apiResponse('success', new OrderResource($order->load('orderProduct.product')), null);
    }

    public function userAddresses(Request $request)
    {
        return ApiHelpers::apiResponse('success', AddressResource::collection(auth()->user()->userAddresses->load('state', 'city')), null);
    }
}
