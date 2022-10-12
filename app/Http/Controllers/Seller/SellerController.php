<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Repositories\Seller\SellerRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Seller\ProfileRequest;
use App\Http\Requests\ChangePasswordRequest;

use App\Models\Order;
use App\Models\State;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Review;
use App\Models\User;
use App\Models\Auth\Seller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{

    protected Seller $authSeller;

    private SellerRepository $sellerRepository;

    public function __construct(SellerRepository $repository)
    {
        $this->sellerRepository = $repository;
        $this->middleware(function (Request $request, $next){
            $this->authSeller = auth()->guard('seller')->user();
            return $next($request);
        });
//        $this->authSeller = Auth::guard('seller')->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
//        Product::query()->where('seller_id',$this->authSeller->id)->get();
        $products = $this->authSeller->products;
        $productsCount  = $products->count();
        $latestProducts = $products->sortByDesc('id')->take(5);
        $branchesCount  = $this->authSeller->sellerBranch()->count();
        $bestSeller     = $products->sortByDesc('sold')->take(5);
        $branches       = $this->authSeller->branches->sortByDesc('id')->take(5);
        $ordersCount = $this->authSeller->sellerOrders->count();

        $ordersRevenue = $this->authSeller->sellerOrders->where('status_id', 5)->sum('total');

        $orders = Order::query()->with('orderProduct')->whereHas('orderProduct',function($q){
                    return $q->where('seller_id',$this->authSeller->id);
                })->orderByDesc('id')->take(5)->get();
//        $orders = $this->authSeller->sellerOrders->where('orderProduct')->where('status_id',1)->sortByDesc('id')->take(5);
//        return $orders->first()->orderProduct->count();
//        return $orders = $this->authSeller->sellerOrders->first()->orderProduct->first()->product;
//        return $this->authSeller->sellerOrders->first()->orderProduct;
//        $usersCount = User::query()->where('is_admin', 0)->where('is_seller', 0)->count();

//        $reviews = Review::orderBy('id', 'desc')->limit(5)->get();
//        $orders_recent = Order::orderBy('id', 'desc')->limit(11)->get();

//        $breadcrumbs = [
//            ['link' => route('admin.home'), 'name' => 'Dashboard']
//        ];
//        return view('seller.index', compact([
//            'breadcrumbs', 'ordersCount', 'productsCount', 'reviews', 'orders_recent'
//        ]));
        return view('seller.index',compact(['productsCount', 'branchesCount', 'bestSeller', 'latestProducts', 'branches', 'orders', 'ordersCount', 'ordersRevenue']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_password()
    {
        $user = $this->authSeller;
        return view('seller.auth.changePW',compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_password(ChangePasswordRequest $request)
    {
        $user = $this->authSeller->makeVisible(['new_password']);

        if (!Hash::check($request->input("currentPW"),$user->password)){
            return redirect()->back()->with(['error'=>__('auth.errPassword')]);
//              return response()->json(['tag'=>false,'msg'=>__('auth.errPassword')]);
        }else{
            try {
                DB::beginTransaction();
                    $this->sellerRepository->changePassword(bcrypt($request->input("new_password")));
                DB::commit();
                return redirect()->route('seller.change.password')->with(['success'=>__('auth.passwordChangedSuccess')]);
            }catch (\Exception $e){
                DB::rollBack();
                return redirect()->route('seller.change.password')->with(['error'=>__('auth.errorSetting')]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->authSeller;
        $states = state::get();
//        return $user->userAddress;
        return view('seller.auth.profile',compact('user','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request, $id)
    {
        $user = $this->authSeller;
        if ($user){
            try{
                $name = $request->input('first_name') . ' ' . $request->input('last_name');
                DB::beginTransaction();
                $users = [
                    'name' => $name,
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'national_id' => $request->input('document_id'),
                    'gender' => $request->input('gender'),
                    'dob' => $request->input('dob'),
                    'is_active' => true,
                    'is_seller' => true,
                ];
                $sellers = [
                    'document_id' => $request->input('document_id'),
                    'store' => $request->input('store'),
                    'user_id' => $id,
                ];
                $userAddresses = [
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'phone' => $request->input('pickup_phone'),
                    'country_id' => 1,
                    'user_id' => $id,
                    'city_id' => $request->input('city'),
                    'state_id' => $request->input('state'),
                    'street' => $request->input('street'),
                    'address' => $request->input('address'),
                    'build_number' => $request->input('build_number'),
                    'postal_code' => $request->input('postal_code'),
                ];
                $this->sellerRepository->update($user,$users, $sellers, $userAddresses);
                DB::commit();
                return redirect()->route('seller.profile.edit',$id)
                    ->with(['success'=>__('auth.successUpdate',['var'=>__('seller.seller')])]);
            }catch(\Exciption $e){
                DB::rollBack();
                return $e->getMessage();
                return redirect()->route('seller.profile.edit',$id)->with(['error'=>__('auth.errorSetting')]);
            }
            return redirect()->route('seller.profile.edit',$id)->with(['error'=>__('auth.errorSetting')]);
        }
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
}
