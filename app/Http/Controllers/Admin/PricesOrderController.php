<?php

namespace App\Http\Controllers\Admin;

use Toaster;
use App\Models\User;
use App\Models\Order;
use App\Models\Point;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\MainSetting;
use App\Models\OrderStatus;
use App\Models\ShippingZone;
use Illuminate\Http\Request;
use App\Models\BundleProduct;
use App\Jobs\AdminPricesReplay;
use App\Models\PriceQuoteOrder;
use App\Models\ShippingCompany;
use App\Models\InventoryProduct;
use Illuminate\Support\Facades\DB;
use App\Models\PriceQuoteOrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Api\FCMController;
use App\Models\Translations\CityTranslation;

//use App\Notifications\Mail\AdminPricesReplay;
use Illuminate\Support\Facades\Notification;
use App\Models\Translations\CountryTranslation;

class PricesOrderController extends Controller
{
    public function index(Request $request)
    {
        $order = PriceQuoteOrder::query()->with(['user', 'user_address', 'status'])
            ->withCount('orderProduct')->orderByDesc('id')->get();

        if ($request->ajax() || $request->has('draw')) {

            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(
                PriceQuoteOrder::query()->with(['user', 'user_address', 'status'])
                    ->withCount('orderProduct')->orderByDesc('id')
            );

            return created_at_filter($DataTables)->editColumn(
                'created_at',
                function (PriceQuoteOrder $order) {
                    return optional($order->created_at)->toDayDateTimeString();
                }
            )->filterColumn('order_status', function ($query, $keyword) {
                $query->where('status_id', $keyword);
            })->addColumn('user_title', function (PriceQuoteOrder $order) {
                return $order->user_address->full_name;
            })->addColumn('user_email', function (PriceQuoteOrder $order) {
                return optional($order->user)->email ?? $order->email;
            })->addColumn('items_count', function (PriceQuoteOrder $order) {
                return $order->order_product_count;
            })->addColumn('user_phone', function (PriceQuoteOrder $order) {
                return $order->user_address->phone;
            })->addColumn('order_status', function (PriceQuoteOrder $order) {
                $color = 'secondary';
                $title = 'New';
                if ($order->status) {
                    $title = $order->status->name;
                    $color = [
                            'new' => 'secondary',
                            'processing' => 'info',
                            'payment' => 'warning',
                            'completed' => 'success',
                            'cancelled' => 'danger',
                            'declined' => 'danger',
                        ][$order->status->type] ?? 'secondary';
                }
                return "<span class=\"badge rounded-pill bg-$color\">{$title}</span>";
            })->addColumn('actions', function (PriceQuoteOrder $order) {
                return [
                    ['url' => route('admin.orders.show', $order), 'icon' => 'eye'],
                ];
            })->only([
                'id', 'actions', 'user_title', 'user_email', 'user_phone', 'order_status', 'items_count', 'created_at',
            ])->rawColumns(['order_status'])->make(true);
        }

        return view('admin.content.orders.priceOrder.index');
    }

    public function cancelled_orders(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(
                PriceQuoteOrder::query()->where('status_id', 6)->with(['user', 'user_address', 'status'])
                    ->withCount('orderProduct')->orderByDesc('id')
            );
            return created_at_filter($DataTables)->editColumn('created_at', function (PriceQuoteOrder $order) {
                return optional($order->created_at)->toDayDateTimeString();
            })->filterColumn('order_status', function ($query, $keyword) {
                $query->where('status_id', $keyword);
            })->addColumn('user_title', function (PriceQuoteOrder $order) {
                return $order->user_address->full_name;
            })->addColumn('user_email', function (PriceQuoteOrder $order) {
                return optional($order->user)->email ?? $order->email;
            })->addColumn('user_phone', function (PriceQuoteOrder $order) {
                return $order->user_address->phone;
            })->addColumn('order_status', function (PriceQuoteOrder $order) {
                $color = 'secondary';
                $title = 'New';
                if ($order->status) {
                    $title = $order->status->name;
                    $color = [
                            'new' => 'secondary',
                            'processing' => 'info',
                            'payment' => 'warning',
                            'completed' => 'success',
                            'cancelled' => 'danger',
                            'declined' => 'danger',
                        ][$order->status->type] ?? 'secondary';
                }
                return "<span class=\"badge rounded-pill bg-$color\">{$title}</span>";
            })->addColumn('actions', function (PriceQuoteOrder $order) {
                return [
                    ['url' => route('admin.orders.show', $order), 'icon' => 'eye'],
                ];
            })->only([
                'id', 'actions', 'user_title', 'user_email', 'user_phone', 'order_status', 'items_count', 'created_at',
            ])->rawColumns(['order_status'])->make(true);
        }

        return view('admin.content.orders.priceOrder.cancelled-orders');
//        $status = OrderStatus::where('name', 'Cancelled')->first();
//        //dd($status);
//        $status_array = explode(',', Auth::user()->order_status_permissions);
//        $orders = Order::where('status_id', $status->id)->get();
//        $main_settings = MainSetting::where('key', 'ended_orders_status')->first();
//
//        if ($main_settings) {
//            $main_settings = explode(',', $main_settings->value);
//        }
//        return view('admin.content.orders.cancelled_orders', compact('orders', 'main_settings'));
    }

    public function create()
    {
        $data = [
            'products' => Product::get(),
            'pattributes' => Attribute::with('childrensRow')->parents()->get(),
            'countries' => CountryTranslation::pluck('name', 'id'),
            'cities' => CityTranslation::pluck('name', 'id')
        ];
        return view('admin.content.orders.create')->with($data);
    }

    public function store(Request $request)
    {
        $pids = $request->input('products');
        $attrs = $request->input('attributes');
        $quantities = $request->input('quantities');

        $productsList = [];
        foreach ($pids as $k => $pid) {
            $productsList[$k]['attributes'] = $attrs[$k];
            $productsList[$k]['quantity'] = $quantities[$k];
        }
        $products = $this->getOrderProducts($pids, $productsList);

        $pInfo = [];
        foreach ($products as $product) {
            $pIds[] = $product['id'];
            $pInfo[] = [
                'attribute_id' => (int)$product['attribute'],
                'price' => $product['price'],
                'quantity' => $product['quantity'],
                'total' => $product['total'],
            ];
        }
        $productFinal = array_combine($pIds, $pInfo);
        # add order
        $request->merge(['user_id' => auth()->id()]);
        $order = Order::create($request->all());

        # assign products
        $order->products()->sync($productFinal);
        $logPayload = ['msg' => 'Order Added', 'model_id' => $order->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.orders.index');
    }

    public function save(Request $request, PriceQuoteOrder $order)
    {
        $order->status_id = $request->status_id;
        $totalPrice = 0;
        $totalPoints = 0;

        $total = $order->products->map(function (Product $product) use ($request, $totalPrice, $totalPoints) {
            if (isset($request->get('inventory')[$product->id])) {
                $product_inventory = InventoryProduct::where('inventory_id', $request->get('inventory')[$product->id])
                    ->where('product_id', $product->id)
                    ->first();
                if ($request->status_id == 2) {
                    $product_inventory->decrement('quantity', $product->pivot->quantity);
                    $product_inventory->save();
                }
            }

            $totalPrice += $product->pivot->price_after;
            $totalPoints += $product->pivot->reward_points;
            return [$totalPrice, $totalPoints];
        });


        if ($order->status_id == 3) { // the status is completed

            $points = new Point;
            $points->user_id = Auth::user()->id;
            $points->points = $total->sum(1);
            $points->total = $total->sum(0) + $request->input('shipping_amount');
            $points->order_id = $order->id;
            $points->save();

            FCMController::sendNotification($order->user_id, $order->status_id);
        }

        $order->save();
        return redirect()->route('admin.orders.index');
    }

    public function show($id)
    {

        $order = PriceQuoteOrder::query()->findOrFail($id);
        $statuses = OrderStatus::query()->get();
        $prices = json_decode($order->orderProduct->map(function ($item) {
            return ($item->product->price * $item->quantity);
        }));

        $totalPrices = array_sum($prices);
//        return ['order'=>$order,'prices'=>$prices,'total'=>$totalPrices];
        return view('admin.content.orders.priceOrder.show-order', compact('order', 'totalPrices', 'statuses'));
    }

    public function edit($id)
    {
        $data = [
            'products' => Product::get(),
            'attributes' => Attribute::childrens()->get(),
            'order' => Order::with('products')->findOrFail($id),
            'countries' => CountryTranslation::pluck('name', 'id'),
            'cities' => CityTranslation::pluck('name', 'id')
        ];
        return view('admin.content.orders.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $pids = $request->input('products');

        $attrs = $request->input('attributes');
        $quantities = $request->input('quantities');
        $productsList = [];
        foreach ($pids as $k => $pid) {
            $attrs_ar = [];
            foreach ($pids as $i => $one) {
                if ($pid == $one) {
                    array_push($attrs_ar, $attrs[$i]);
                }
            }
            $productsList[$k]['product_id'] = $pid;
            $productsList[$k]['attributes'] = implode(',', $attrs_ar);
            $productsList[$k]['quantity'] = $quantities[$k];
        }
        $products = $this->getOrderProducts($pids, $productsList);

        $pInfo = [];
        foreach ($products as $product) {
            $pIds[] = $product['id'];
            $pInfo[] = [
                'attribute_id' => $product['attribute'],
                'price' => $product['price'],
                'quantity' => $product['quantity'],
                'total' => $product['total'],
            ];
        }
        $productFinal = array_combine($pIds, $pInfo);
        $order = Order::findOrFail($id);
        $order->update($request->all());
        # assign products

        $order->products()->sync($productFinal);
        $logPayload = ['msg' => 'Order Updated', 'model_id' => $order->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.orders.index');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        $order->products()->detach();
        return redirect()->route('admin.orders.index');
    }

    public function getOrderProducts($pids, $productsList)
    {
        $products = Product::with('translations:id,product_id,name,locale,slug')
            ->whereIn('id', $pids)
            ->select('id', 'thumbnail', 'price')
            ->get();

        $counter = 0;
        $products = $products->map(function ($item, $k) use ($pids, $productsList) {
            $outPut = [];
            $outPut['id'] = $item['id'];
            $outPut['name'] = $item['name'];
            $outPut['price'] = $item['price'];
            $outPut['attribute'] = $productsList[$k]['attributes'];
            $outPut['quantity'] = $productsList[$k]['quantity'];
            $outPut['price'] = $item['price'];
            $outPut['total'] = $item['price'] * $outPut['quantity'];
            return $outPut;
        })->all();

        return $products;
    }

    public function show_bundle($id, $bundle_id)
    {
        $order = Order::find($id);
        $product = $order->products()->where('is_bundle', 1)->get();
        $bundle = $product->where('id', $bundle_id)->first();
        $product_ids = BundleProduct::where('bundle_id', $bundle->id)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $product_ids)->get();
        return view('admin.content.orders.showBundle', compact('bundle', 'products', 'order'));
    }

    public function updateOrderPrice(Request $request, $order)
    {
        $Order = PriceQuoteOrder::query()->findOrFail($order);

//        $Order = PriceQuoteOrder::query()->findOrFail($order);
//
        $items = collect($request->get('items'));
        $prices = $items->map(function ($item) {
            return ($item['price']*$item['quantity']);
        });
//
        $totalPrices =  array_sum(json_decode($prices));

        try {
//            return $Order->orderProduct;
            DB::beginTransaction();
            foreach ($items as $item) {
                $orderItem = $Order->orderProduct->where('product_id', $item['product_id'])->first();
                $totalItem = $item['price']*$item['quantity'];
                $orderItem->update(['price'=>$item['price'],'total'=>$totalItem]);
            }

            if ($request->input('status') != $Order->status_id) {
                FCMController::sendNotification($Order->user_id, $Order->status_id);
            }

            $Order->update(['status_id'=>$request->input('status'),'admin_id'=>\auth()->user()->id,'viewed_at'=>now(),'total'=>$totalPrices]);

            $mailData = (object)[
                'name' => $Order->user_address->first_name. ' ' . $Order->user_address->last_name,
                'email' => $Order->user->email,
                'order_id' => $Order->id,
                'total' => $Order->total,
                'viewed_at' => $Order->viewed_at,
            ];

            DB::commit();

            try {
                AdminPricesReplay::dispatch($mailData)->delay(\Carbon\Carbon::now()->addSeconds(5));
            } catch (\Exception $e) {
            }

            return redirect()->back()->with(['success'=>'Order Date Saved Successfully','success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            Toaster::Error('Error While Saving Data Try again Later', 'error');
        }

        return redirect()->back();
    }
}
