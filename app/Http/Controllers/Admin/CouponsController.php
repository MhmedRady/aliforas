<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponsRequest;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\CouponLog;
use App\Models\Product;

class CouponsController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('permission:view_coupon');
        $this->middleware('permission:create_coupon', ['only' => ['create','store']]);
        $this->middleware('permission:edit_coupon', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_coupon', ['only' => ['destroy']]); */
    }

    public function index(\Illuminate\Http\Request $request)
    {
        $data = ['rows' => Coupon::with('products')->get()];
        return view('admin.content.coupons.index')->with($data);
    }

    public function create()
    {

        $categories = Category::listsTranslations('name', 'id')->pluck('name', 'id');
        $products = Product::listsTranslations('name', 'id')->pluck('name', 'id');

        $data = [
            'products' => $products,
            'categories' => $categories
        ];

        return view('admin.content.coupons.create')->with($data);

    }

    public function store(CouponsRequest $request)
    {
        $request->merge(['is_active' => $request->has('is_active')]);

        #Check Priority
        // if(PrioritySetting::first()->enable==1){
        //     $order_id=\App\Priority::where('name','promotion')->first()->order_id;
        //     foreach($request->product_id as $i => $id){
        //         if(!priority($order_id,$id)){
        //             $sub_product=Product::find($id);
        //             session()->flash('has_not_Priority','You canot add this offer has priority low with product "' . $sub_product->{'name:en'} .'"');
        //             return back();
        //         }
        //     }
        // }

        $coupon = Coupon::create($request->all());
        # attach products
        $coupon->products()->sync($request->input('product_id'));
        # attach categories
        $coupon->categories()->sync($request->input('category_id'));
        $cat_ids = $coupon->categories()->pluck('id')->toArray();
        $product_ids = [];
        foreach ($cat_ids as $id) {
            $cat = Category::find($id);
            $product_ids = $cat->products->pluck('id')->toArray();
            $coupon->products()->attach($product_ids);
        }
        # Delete Another Offers
        // dd($request->product_id);
        // foreach($request->product_id as $i => $id){
        //     $sub_product=Product::find($id);
        //     $sub_product->on_sale=0;
        //     $sub_product->is_hot=0;
        //     $sub_product->promotions()->sync([]);
        //     $sub_product->save();
        //     BundleProduct::where('product_id',$id)->delete();
        //     ProductCombo::where('product_id',$id)->delete();
        // }

        $logPayload = ['msg' => 'Coupon Added', 'model_id' => $coupon->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.coupons.index');
    }

    public function show($id)
    {
        $coupon = Coupon::with('products', 'categories')->find($id);
        $log = CouponLog::where('coupon', $coupon->code)->get()->count();
        $data = ['row' => Coupon::find($id), 'log' => $log];
        return view('admin.content.coupons.show')->with($data);
    }

    public function edit($id)
    {
        $categories = Category::get();
        $products = Product::get();
        $coupon = Coupon::with('products', 'categories')->find($id);
        $log = CouponLog::where('coupon', $coupon->code)->get()->count();
        $coupon->products = $coupon->products->pluck('id');
        $coupon->categories = $coupon->categories->pluck('id');
        $data = ['row' => $coupon, 'products' => $products, 'categories' => $categories, 'log' => $log];
        return view('admin.content.coupons.edit')->with($data);
    }

    public function update(CouponsRequest $request, $id)
    {
        $request->merge(['is_active' => $request->has('is_active')]);
        //Check Priority
        // if(PrioritySetting::first()->enable==1){
        //     $order_id=\App\Priority::where('name','coupon')->first()->order_id;
        //     foreach($request->product_id as $i => $id2){
        //         if(!priority($order_id,$id2)){
        //             $sub_product=Product::find($id2);
        //             session()->flash('has_not_Priority','You canot add this offer has priority low with product "' . $sub_product->{'name:en'} .'"');
        //             return back();
        //         }
        //     }
        // }

        $coupon = Coupon::find($id);
        $coupon->update($request->all());
        # attach products
        $coupon->products()->sync($request->input('product_id'));
        # attach categories
        $coupon->categories()->sync($request->input('category_id'));
        $cat_ids = $coupon->categories()->pluck('id')->toArray();
        $product_ids = [];
        foreach ($cat_ids as $id) {
            $cat = Category::find($id);
            $product_ids = $cat->products->pluck('id')->toArray();
            $coupon->products()->attach($product_ids);
        }
        //Delete Another Offers
        // foreach($request->product_id as $i => $id){
        //     $sub_product=Product::find($id);
        //     $sub_product->on_sale=0;
        //     $sub_product->is_hot=0;
        //     $sub_product->save();
        //     $sub_product->promotions()->sync([]);
        //     BundleProduct::where('product_id',$id)->delete();
        //     ProductCombo::where('product_id',$id)->delete();
        // }

        $logPayload = ['msg' => 'Coupon Updated', 'model_id' => $coupon->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.coupons.index');
    }

    public function destroy($id)
    {
        Coupon::find($id)->delete();
        return redirect()->route('admin.coupons.index');
    }
}
