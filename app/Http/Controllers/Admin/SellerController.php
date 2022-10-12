<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\State;
use App\Models\Language;
use App\Models\Auth\Seller;
use App\Models\UserAddress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Seller\ProfileRequest;
use App\Repositories\Seller\SellerRepository;

class SellerController extends Controller
{
    /**
     * @var SellerRepository
     */
    private $sellerRepository;

    public function __construct(SellerRepository $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    public function index(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(Seller::with(['products', 'branches'])
            ->withCount(['products', 'branches'])
            ->orderByDesc('id'));

            return created_at_filter($DataTables)
            ->filterColumn('name', function ($q, $word) {
                return $q->where('name', 'like', [(config('datatables.search.smart') === true?'%':'') . "$word%"]);
            })
            ->filterColumn('is_active', function ($q, $word) {
                $status = request()->columns[5]['search']['value'];
                if (Str::startsWith('a', $status) || Str::startsWith('ac', $status) || Str::startsWith('act', $status) || Str::startsWith('acti', $status) || Str::startsWith('activ', $status) || Str::startsWith('active', $status)) {
                    $status = 1;
                }
                if (Str::startsWith('i', $status) || Str::startsWith('in', $status) || Str::startsWith('ina', $status) || Str::startsWith('inac', $status) || Str::startsWith('inact', $status) || Str::startsWith('inacti', $status) || Str::startsWith('inactiv', $status) || Str::startsWith('inactive', $status)) {
                    $status = 0;
                }
                $q->where('is_active', $status);
            })

            ->editColumn('created_at', function (Seller $seller) {
                return optional($seller->created_at)->toDayDateTimeString();
            })->editColumn('update_url', function (Seller $seller) {
                return route('admin.seller.edit', $seller);
            })->addColumn('products', function (Seller $seller) {
                return $seller->products->count();
            })->addColumn('branches', function (Seller $seller) {
                return $seller->sellerBranch->count();
            })->editColumn('phone', function (Seller $seller) {
                return $seller->phone;
            })->editColumn('actions', function (Seller $seller) {
                return [
                    ['url' => route('admin.seller.activation', $seller), 'icon' => $seller->is_active ? 'x-circle' : 'check-circle',]
                ];
            })->editColumn('status', function (Seller $seller) {
                return $seller->is_active ?
                    '<label class="badge rounded-pill bg-success">'.__('auth.active').'</label>' :
                    '<label class="badge rounded-pill bg-danger">'.__('auth.inActive').'</label>';
            })->editColumn('is_active', function (Seller $seller) {
                return $seller->is_active ?
                    '<label class="badge rounded-pill bg-success">'.__('auth.active').'</label>' :
                    '<label class="badge rounded-pill bg-danger">'.__('auth.inActive').'</label>';
            })->only([
                    'id', 'name', 'phone', 'status', 'products', 'branches', 'is_active', 'actions', 'created_at', 'update_url', 'delete_url',
                ])->rawColumns(['status', 'products', 'is_active', 'branches'])->make(true);
        }

        return view('admin.content.sellers.index');
    }

    public function edit($id)
    {
        $user = Seller::query()->find($id);
        $states = state::get();
        return view('admin.content.sellers.profile', compact('user', 'states'));
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
        $user = Seller::query()->findOrFail($id);

//        if ($user->userAddress->count()){
//            return 'has';
//        }else {
//            return 'no';
//        }
        try {
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
                    'user_id' => $id,
                    'document_id' => $request->input('document_id'),
                    'store' => $request->input('store'),
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
            $this->sellerRepository->update($user, $users, $sellers, $userAddresses);
            DB::commit();
            session()->flash('success');
            return redirect()->route('admin.seller.index')
                    ->with(['success'=>__('auth.successUpdate', ['var'=>__('seller.seller')])]);
        } catch (\Exciption $e) {
            DB::rollBack();
            return redirect()->route('admin.seller.edit', $id)->with(['error'=>__('auth.errorSetting')]);
        }
    }

    public function activation($id)
    {
        $seller = Seller::query()->findOrFail($id);
        $seller->update(['is_active'=> !$seller->is_active]);
        return redirect()->route('admin.seller.index');
    }

    public function show($id)
    {
        $seller = Seller::where("id", $id)->with(["seller", "sellerFile", "sellerBranch"])->first();

        return view('admin.content.sellers.profile', compact("seller"));
    }

    public function edit_profile($id, Request $seller)
    {
        return $this->sellerRepository->admin_update_seller($seller);
    }
}
