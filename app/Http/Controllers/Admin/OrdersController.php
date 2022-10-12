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

class OrdersController extends Controller
{
    public function index(Request $request)
    {
//        return Order::query()->with(['user', 'user_address', 'status'])
//            ->withCount('products')->orderByDesc('id')->get()->first()->user->email;
        if ($request->ajax() || $request->has('draw')) {
            if (config('setting.pricing') === true) {
            }
            /** @var EloquentDataTable $DataTables */
            return $this->ajaxData();
        }
        return view('admin.content.orders.index');
    }

    public function cancelled_orders(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            return $this->ajaxData('status_id', 6);
        }
        $title = __('layouts.canceledOrders');

        return view('admin.content.orders.index', compact('title'));
    }

    public function ajaxData($column = null, $operator = null)
    {
        $DataTables = DataTables::of(
            config('setting.pricing') ?
                    Order::query()->with(['user', 'user_address', 'status'])->where($column, $operator)
                        ->withCount('products')->orderByDesc('id') :
                    PriceQuoteOrder::query()->with(['user', 'user_address', 'status'])->where($column, $operator)
                        ->withCount('products')->orderByDesc('id')
        );

        return created_at_filter($DataTables)->editColumn('created_at', function (Order $order) {
            return optional($order->created_at)->toDayDateTimeString();
        })
            ->filterColumn('order_status', function ($query, $keyword) {
                $query->where('status_id', $keyword);
            })
            ->filterColumn('user_email', function ($q, $word) {
                $q->whereHas('user', function ($q) use ($word) {
                    $q->where('email', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$word%"]);
                });
            })
            ->filterColumn('user_phone', function ($q, $word) {
                $q->whereHas('user_address', function ($q2) use ($word) {
                    $q2->where('phone', 'like', "$word%");
                })->orWhereHas('user', function ($q2) use ($word) {
                    $q2->where('phone', 'like', "$word%");
                });
            })
            ->filterColumn('user_title', function ($q, $word) {
                $q->whereHas('user_address', function ($q) use ($word) {
                    $q->where('first_name', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$word%"])
                        ->orWhere('last_name', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$word%"]);
                });
            })

            ->addColumn('user_title', function (Order $order) {
                if (is_null($order->user_address)) {
                    return $order->user->name;
                }
                return ($order->user_address->first_name??'') . ' ' .($order->user_address->last_name??'');
            })
            ->addColumn('user_email', function (Order $order) {
                return optional($order->user)->email ?? $order->email;
            })
            ->addColumn('user_phone', function (Order $order) {
                return ($order->user_address->phone??$order->user->phone);
            })
            ->addColumn('items_count', function (Order $order) {
                return $order->products_count;
            })
            ->addColumn('order_status', function (Order $order) {
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
            })->addColumn('actions', function (Order $order) {
                return [
                    ['url' => route('admin.orders.show', $order), 'icon' => 'eye'],
                ];
            })
            ->only([
                'id', 'actions', 'user_title', 'user_email', 'user_phone', 'order_status', 'items_count', 'created_at',
            ])->rawColumns(['order_status'])->make(true);
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

    public function save(Request $request, Order $order)
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
            $points = new Point();
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

    public function viewOrderPrice($id)
    {
        $order = PriceQuoteOrder::query()->findOrFail($id);
        $statuses = OrderStatus::query()->get();
        $prices = json_decode($order->orderProduct->map(function ($item) {
            return ($item->product->price * $item->quantity);
        }));

        $totalPrices = array_sum($prices);

        return view('admin.content.orders.priceOrder.show-order', compact('order', 'totalPrices', 'statuses'));
    }

    public function show($id)
    {
        $order = Order::with(['user','products','orderProduct'=>function ($q) {
            $q->with('product');
        }])->findOrFail($id);
//        return $order->orderByDesc('id')->first()->orderProduct;
        if (!$order->orderProduct->count() > 0) {
            return redirect(404);
        }
        $statuses = OrderStatus::query()->get();

        $prices = json_decode($order->orderProduct->map(function ($item) {
            return ($item->product->price * $item->quantity);
        }));

        $totalPrices = array_sum($prices);

        return view('admin.content.orders.show-order', compact('order', 'totalPrices', 'statuses'));


//        Order::with('products')->find($id);
//        $main_settings = MainSetting::where('key', 'ended_orders_status')->first();
//
//        if ($main_settings) {
//            $main_settings = explode(',', $main_settings->value);
//        }
//        $order = Order::with('products')->findOrFail($id);
//        $total_price = 0;
//        $weights = 0;
//        $counter = 0;
//        $order->products->map(function (Product $product) use (&$total_price, &$weights, &$counter) {
//            if ($product->pivot->total != $product->pivot->price_after) {
//                $total_price += $product->pivot->price_after;
//            } else {
//                $total_price += $product->pivot->total;
//            }
//            $weights += (($product->length * $product->width * $product->height) / 3000) * $product->pivot->quantity;
//            return $product;
//        });
//
//        $shipping_zone = ShippingZone::all();
//        $results = [];
//        $company_id = 0;
//        $cod = 0;
//        $fuel = 0;
//        $post = 0;
//        $vat = 0;
//        $cod = 0;
//        $company = null;
//        foreach ($shipping_zone as $zone) {
//            $total_shipping = 0;
//            if (in_array($order->state, json_decode($zone->areas))) {
//                $zone_id = $zone->id;
//                $first_kg = $zone->first_kg;
//                $additional_kg = $zone->additional_kg;
//                $company_id = $zone->company_id;
//                $company = ShippingCompany::find($company_id);
//                $first_kg_number = $company->first_kg_number;
//                $cod_values = explode(',', $zone->cod_values);
//
//
//                $adds_kgs = $first_kg_number - (int)$weights;
//                $adds_kgs = str_replace('-', '', $adds_kgs);
//                if ((int)$weights > $first_kg_number) {
//                    $total_shipping += (int)$first_kg;
//                    $total_shipping += $adds_kgs * $additional_kg;
//                } else {
//                    $total_shipping += (int)$first_kg;
//                }
//            }
//
//            // Shipping Properties Checker
//            if ($company_id != 0) {
//                $fuel = $company->fuel;
//                $post = $company->post;
//                $vat = $company->vat;
//                $cod = $company->cod;
//            }
//
//            // COD Values Checker
//            if ($cod != 0) {
//                $selected_cod = 0;
//                $cods = explode(',', $cod);
//                $i = 0;
//                foreach ($cods as $item) {
//                    if ($item <= $total_price) {
//                        $selected_cod = $i;
//                    }
//                    $i++;
//                }
//                if (isset($selected_cod) && $selected_cod != 0) {
//                    $cod = $cod_values[$selected_cod];
//                    if (strpos($cod, '%') !== false) {
//                        $total_shipping += $total_price * str_replace('%', '', $cod) / 100;
//                    } else {
//                        $total_shipping += $cod;
//                    }
//                }
//            }
//
//            if ($fuel != 0) {
//                $total_shipping += $total_shipping * $fuel / 100;
//            }
//            if ($post != 0) {
//                $total_shipping += $total_shipping * $post / 100;
//            }
//            if ($vat != 0) {
//                $total_shipping += $total_shipping * $vat / 100;
//            }
//            if ($company != null) {
//                array_push($results, ['company_id' => $company_id, 'company_name' => $company->name, 'cost' => $total_shipping]);
//            } else {
//                array_push($results, ['company_id' => $company_id, 'company_name' => '', 'cost' => $total_shipping]);
//            }
//        }
//        return view('admin.content.orders.show', compact('order', 'total_price', 'results', 'main_settings'));
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
        $Order = Order::query()->findOrFail($order);

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
            $sipping_at = null;
            if ($request->input('status') == 5) {
                $sipping_at = now();
            }

            if ($request->input('status') != $Order->status_id) {
                FCMController::sendNotification($Order->user_id, $Order->status_id);
            }

            $Order->update([
                'status_id'=>$request->input('status'),
                'admin_id'=>\auth()->user()->id,
                'viewed_at'=>now(),'total'=>$totalPrices,
                'shipped_at'=>$sipping_at,
            ]);

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
